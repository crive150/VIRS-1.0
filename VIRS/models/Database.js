// Hold Database connection information

var mysql = require('mysql');

var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : 'root',
  database : 'virs'
});

module.exports = connection;

//connection.end();




