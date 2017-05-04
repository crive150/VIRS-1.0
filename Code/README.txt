Vocabulary in Reading (VIR) Version 1.0

This folder consists of the code for 2 web apps:
1. WebApp Admin Panel: VIRS_Admin_Panel_v2.0
2. WebApp mobile format: VIRS

WebApp Admin Panel (built using MySQL, PHP, and bootstrap) consists of a directory structure which has
1. Connections for database
2. CSS folder for styling
3. fonts folder
4. js folder for javascripts to provide functionality
5. upload folder
6. then a list of php files for MySQL communication and queries as well as logic.

The WebApp mobile format has (built using NodeJS, ExpressJS, AngularJS, and MySQL for database):
1. bin folder
2. models folder holding the database connection info in a js file inside
3. node_modules folder
4. public folder holding:
  1.images folder: images used in the site.
  2.javascripts folder: contains angularJS files and javascript logic and functionality files.
  3.stylesheets: contains CSS files
5. routes folder which holds expressJS files for routing information from back-end to front-end.
6. views folder: contains the ejs files which replace the html files. Contains the html code with injections from angularJS
7. app.js file to put everything together and run the nodeJS app
8. package.json file
