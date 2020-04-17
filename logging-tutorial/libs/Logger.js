const os = require("os");
const winston = require("winston");
const Sentry = require("winston-sentry-log");
const LocalStorage = require("./LocalStorage");

const { splat, combine, timestamp, printf } = winston.format;

class Logger {
  constructor(name, options = {}) {
    this.name = name;
    this.hostname = os.hostname();

    this.logger = winston.createLogger({
      level: options.logLevel,
      defaultMeta: { service: name },
      transports: [
        new winston.transports.Console({
          format: winston.format.combine(
            winston.format.timestamp(),
            winston.format.metadata({
              fillExcept: ["timestamp", "service", "level", "message"]
            }),
            winston.format.colorize(),
            this.winstonConsoleFormat()
          )
        }),
        new winston.transports.File({
          filename: "./logs/" + name + ".log",
          format: winston.format.combine(
            winston.format.errors({ stack: true }),
            winston.format.metadata(),
            winston.format.json()
          )
        }),
        new Sentry({
          config: {
            dsn: process.env.SENTRY_DSN
          },
          level: "warn"
        })
      ]
    });

    if (options.sensitiveFields) {
      this.sensitiveFields = options.sensitiveFields;
      this.checkSensitiveFields = true;
    }
  }

  winstonConsoleFormat() {
    return printf(({ timestamp, level, message, metadata }) => {
      const metadataString = metadata != null ? JSON.stringify(metadata) : "";
      return `[${timestamp}][${level}][${this.name}@${
        this.hostname
      }] ${message}. ${"METADATA: " + metadataString}`;
    });
  }
  // We expose four levels of logging for this tutorial

  debug(log, metadata) {
    this.log("debug", log, metadata);
  }

  info(log, metadata) {
    this.log("info", log, metadata);
  }

  warn(log, metadata) {
    this.log("warn", log, metadata);
  }

  error(log, metadata) {
    this.log("error", log, metadata);
  }

  log(level, log, metadata, stackTrace) {
    const store = LocalStorage.getStore();
    const metadataObject = {};

    if (store) {
      metadataObject.uniqueId = store.id;
    }

    if (metadata) metadataObject.metadata = metadata;
    if (stackTrace) metadataObject.stackTrace = stackTrace;

    if (this.checkSensitiveFields) {
      const sensitiveFieldFound = Object.keys(
        metadataObject.metadata || {}
      ).find(key => this.sensitiveFields.includes(key));
      if (sensitiveFieldFound)
        return this.logTrace(
          "warn",
          `You tried to log the following sensitive key: "${sensitiveFieldFound}". Please check attached stack trace.`
        );
    }

    if (log instanceof Error) {
      return this.logger[level](log.message, {
        metadata: { stack: log.stack }
      });
    }

    this.logger[level](JSON.stringify(log), JSON.stringify(metadataObject));
  }

  logTrace(level, log, metadata) {
    const stackTrace = new Error().stack;
    this.log(level, log, metadata, stackTrace);
  }
}

module.exports = new Logger(process.env.APP_NAME, {
  logLevel: process.env.LOG_LEVEL
});

// We will also expose a function if we want
// to use the logger with custom parameters
module.exports.getLogger = (name, options) => {
  return new Logger(name, options);
};
