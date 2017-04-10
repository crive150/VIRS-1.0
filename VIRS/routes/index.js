var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

module.exports = router;

/* ----------------------Code written by Senior Project Team Begins---------------------- */ 
// Express Routing
var connection = require('../models/Database'); // Importing conenction
//Connect to mySQL Database
connection.connect();

// Getting all data from table hi and passing it to k1 front end. 
// Also known as high frequency words
router.get('/k1', (req, res, next)=>{
  var queryHi = 'SELECT * FROM hi';
  
  connection.query(queryHi, (err, results, field)=>{
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

// Getting all data from table med and passing it to k2 front end. 
// Also known as medium frequency words
router.get('/k2', (req, res, next)=>{
  var queryMed = 'SELECT * FROM med';
  
  connection.query(queryMed, (err, results, field)=>{
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

// Getting all data from table med and passing it to k2 front end. 
// Also known as medium frequency words
router.get('/offlist', (req, res, next)=>{
  var queryLow = 'SELECT * FROM lo';
  
  connection.query(queryLow, (err, results, field)=>{
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

// Getting all data from table awl and passing it to awl front end
router.get('/awl', (req, res, next)=>{
  var queryAwl = 'SELECT * FROM awl';
  
  connection.query(queryAwl, (err, results, field)=>{
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
