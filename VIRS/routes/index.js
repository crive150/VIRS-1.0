var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

module.exports = router;


/* Code written by Senior Project Team Begins */ 
// Express Routing

var mongoose = require('mongoose'); // Importing mongoose
var Kone = mongoose.model('Kone'); // The handle to Kone Schema


// Retrieves all K1 words and returns a JSON list containing all the K1 words
router.get('/k1', function(req, res, next) { // Defining URL for the route k1
  Kone.find(function(err, words){
    if(err){ return next(err); } // Error handling function

    res.json(words);
  });
});

// Creates a new k1 word and saves it in memory before saving it to the database
router.post('/k1', function(req, res, next) {
  var kone = new Kone(req.body);

  kone.save(function(err, post){
    if(err){ return next(err); }

    res.json(kone);
  });
});

// Preloads kone objects
router.param('kone', function(req, res, next, id){
  var query = Kone.findById(id);

  query.exec(function (err, kone){ 
    if (err) { return next(err); }
    if (!kone) { return next(new Error('can\'t find the K1 word')) }

    req.kone = kone;
    return next();
  });
});



/* Code written by Senior Project Team Ends */ 
