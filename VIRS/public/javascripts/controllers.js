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
    {title: 'word 1', definition: "definition 1", frequency: 1},
    {title: 'word 2', definition: "definition 2", frequency: 2},
    {title: 'word 3', definition: "definition 3", frequency: 3},
    {title: 'word 4', definition: "definition 4", frequency: 4},
    {title: 'word 5', definition: "definition 5", frequency: 5}
  ];

  $scope.addWord = function() {
    $scope.words.push({title: 'Technology', definition: 'Application of scientific knowledge', frequency: 1})
  }
}]);