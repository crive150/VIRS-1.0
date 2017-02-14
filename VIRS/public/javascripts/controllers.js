// Controllers

app.controller('MainCtrl', [
'$scope',
function($scope){
  
}]);

app.controller('K1Ctrl', [
'$scope',
'$stateParams',
function($scope, $stateParams){
    $scope.test = 'Hello world!';
    $scope.words = [
    {title: 'word 1', upvotes: 5},
    {title: 'word 2', upvotes: 2},
    {title: 'word 3', upvotes: 15},
    {title: 'word 4', upvotes: 9},
    {title: 'word 5', upvotes: 4}
  ];
}]);