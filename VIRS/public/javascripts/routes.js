// Angular routing
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
          controller: 'K1Ctrl'
        });

      $urlRouterProvider.otherwise('home');
}]);