// Angular Controllers

app.controller('MainCtrl', [
'$scope',
function($scope){
  
}]);

app.controller('K1Ctrl', [
'$scope',
'k1',
'$stateParams',
function($scope, k1, $stateParams){
  
  $scope.words = k1.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    $scope.words.push({title: $scope.title, definition: $scope.definition, frequency: 1});
    $scope.title = '';
    $scope.definition = '';
  };
}]);