require('dotenv').config();
global.__basedir = __dirname;

const express = require('express');
const { uuid } = require('uuidv4')
const LocalStorage = require('./libs/LocalStorage')

const app = express();
const port = process.env.SERVER_PORT;


const Post = require('./models/Post');
const logger = require('./libs/Logger');
const {getLogger} = require('./libs/Logger');

app.get('/logging-tutorial/v1/post/:id', function (req, res) {
  // We have created a fake model class with a function that returns a post in case id === 1, or null in all other cases
  
  const post = Post.find(req.params.id); //In a real world example we would await or use promise based structure
  return res.json({post});
});

app.get('/logging-tutorial/v2/post/:id', function (req, res) {
  try {
    const id = req.params.id;
    const post = Post.find(id); // We assume that we have some kind of ORM in the app.

    if (!post) {
      console.log(`Post with id ${id} was not found`);
      return res.status(404).json({error: 'Post not found'});
    }

    return res.json({post});
  } catch(e) {
    console.log(e);
    return res.status(500).json({error: 'Something went wrong'});
  }
});

app.get('/logging-tutorial/logger', function(req, res) {
  logger.info('I am a log', {author: 'dEVELOPER', tutorial: 'Logging tutorial'});
  return res.json({logged: true});
});

app.get('/logging-tutorial/trace', function(req, res) {
  logger.info('I am a trace log');
  return res.json({logged: true});
});

app.get('/logging-tutorial/sensitiveFields', function(req, res) {
  const secureLogger = getLogger(process.env.APP_NAME, {level: 'info', sensitiveFields: ['password']});

  secureLogger.info('Lets log a password!!!', {name: 'George', password: 'supersecurepassword'});

  return res.json({logged: true});
});

app.get('/logging-tutorial/v1/automated-error-handling', function(req, res) {
  try {
      Post.find(3);
      return res.json({success: true})
  } catch(e) {
      logger.error(e);
      return res.status(500).json({error: 'Something went wrong'});
  }
});

app.get('/logging-tutorial/v2/automated-error-handling', function(req, res) {
  Post.find(3);
  return res.json({success: true})
});

app.get('/logging-tutorial/async-hook', function(req, res) {
    const store = LocalStorage.enterWith({id: uuid()});
    logger.info('I am the first log');
    logger.info('I am the second log');
    logger.info('I am the third log');
    return res.json({});
})

app.use(require('./middlewares/postErrorHandler'))

app.listen(port, () => logger.info(`Example app listening at http://localhost:${port}`, {port}));