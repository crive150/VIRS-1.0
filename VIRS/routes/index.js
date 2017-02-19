var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

module.exports = router;

// Express Routing
/* Code written by Senior Project Team Begins */ 

var mongoose = require('mongoose'); // Importing mongoose
var Kone = mongoose.model(Kone); // Handle to Kone Schema


// Retrieves all K1 words and returns a JSON list containing all the K1 words
router.get('/k1', function(req, res, next) { // Defining URL for the route k1
  Kone.find(function(err, words){
    if(err){ return next(err); } // Error handling function

    res.json(words);
  });
});


// Creates a new k1 word and saves it in memory before saving it to the database
router.post('/k1', function(req, res, next) {
  var kone = new kone(req.body);

  kone.save(function(err, post){
    if(err){ return next(err); }

    res.json(kone);
  });
});




/* Code written by Senior Project Team Ends */ 
