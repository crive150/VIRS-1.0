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
        .state('k1', {
          url: '/k1',
          templateUrl: '/k1.html',
          controller: 'K1Ctrl',
          resolve: {
            k1Promise: ['k1', function(k1){
              return k1.getAll();
            }]
          }
        })
        .state('awl', {
          url: '/awl',
          templateUrl: '/awl.html',
          controller: 'AWLCtrl',
          resolve: {
            awlPromise: ['awl', function(awl){
              return awl.getAll();
            }]
          }
        });

      $urlRouterProvider.otherwise('home');
}]);