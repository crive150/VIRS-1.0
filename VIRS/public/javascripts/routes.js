// Angular Routing
app.config([
  '$stateProvider',
  '$urlRouterProvider',
  function($stateProvider, $urlRouterProvider) {
     
     $stateProvider
        .state('home', {
          url: '/home',
          templateUrl: '/home.html',
          controller: 'MainCtrl'
        })
        .state('k1', { // State for K1 aka High Frequency words
          url: '/k1',
          templateUrl: '/k1.html',
          controller: 'K1Ctrl',
          resolve: {
            k1Promise: ['k1', function(k1){
              return k1.getAll();
            }]
          }
        })
        .state('k2', { // State for K2 aka High Frequency words
          url: '/k2',
          templateUrl: '/k2.html',
          controller: 'K2Ctrl',
          resolve: {
            k2Promise: ['k2', function(k2){
              return k2.getAll();
            }]
          }
        })
        .state('awl', { // State for Academic Word List (awl)
          url: '/awl',
          templateUrl: '/awl.html',
          controller: 'AWLCtrl',
          resolve: {
            awlPromise: ['awl', function(awl){
              return awl.getAll();
            }]
          }
        })
        .state('offlist', { // State for Offlist aka Low Frequency words
          url: '/offlist',
          templateUrl: '/offlist.html',
          controller: 'OfflistCtrl',
          resolve: {
            offlistPromise: ['offlist', function(offlist){
              return offlist.getAll();
            }]
          }
        });

      $urlRouterProvider.otherwise('home');
}]);