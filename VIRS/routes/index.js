var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

module.exports = router;


/* Code written by Senior Project Team Begins */ 
// Express Routing
var connection = require('../models/Database'); // Importing conenction
//Connect to mySQL Database
connection.connect();

// Getting all data from table awl and passing it to awl front end
router.get('/awl', (req, res, next)=>{
  var queryFreq = 'SELECT * FROM freq WHERE freq="2"';
  
  connection.query(queryFreq, (err, results, field)=>{
    if(err) console.log(err);

    let tempArray = [];
    var tempJSON = {};

    results.forEach((item, index) => {
      tempJSON = {
        "freq" : results[index].freq,
        "family": results[index].family,
        "member1" : results[index].member1,
        "freq1" : results[index].freq1,
        "member2" : results[index].member1,
        "freq2" : results[index].freq1,
        "member3" : results[index].member3,
        "freq3" : results[index].freq3,
        "member4" : results[index].member4,
        "freq4" : results[index].freq4
      };
      tempArray.push(tempJSON);
    });

    res.json(tempArray);
  });
});

// Getting all data from table hi and passing it to k1 front end
router.get('/k1', (req, res, next)=>{
  var queryFreq = 'SELECT * FROM hi';
  
  connection.query(queryFreq, (err, results, field)=>{
    if(err) console.log(err);

    let tempArray = [];
    var tempJSON = {};
    
    results.forEach((item, index) => {
      tempJSON = {
        "id" : results[index].id,
        "word": results[index].word
      };
      tempArray.push(tempJSON);
    });

    res.json(tempArray);
  });
});

/* Code written by Senior Project Team Ends */ 
