const assert = require('assert');
const { addNumbers } = require('../src/index.js')

describe('addNumbers function', function() {
    it('should return 3 if we add the numbers 2 and 1', function() {
        assert.equal(addNumbers(1, 2), 3)
    });
});
