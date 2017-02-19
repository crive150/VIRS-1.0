// Angular Controllers

app.controller('MainCtrl', [
'$scope',
function($scope){
  
}]);

app.controller('K1Ctrl', [
'$scope',
'words',
'$stateParams',
function($scope, words, $stateParams){
  
  $scope.words = words.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    $scope.words.push({title: $scope.title, definition: $scope.definition, frequency: 1});
    $scope.title = '';
    $scope.definition = '';
  };
}]);