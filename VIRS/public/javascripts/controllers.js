// Angular Controllers

app.controller('MainCtrl', [
'$scope',
function($scope){
  
}]);

app.controller('K1Ctrl', [
'$scope',
'k1',
function($scope, k1){
  
  $scope.words = k1.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    k1.create({
      title: $scope.title, 
      definition: $scope.definition, 
      frequency: 1
    });
    $scope.incrementFrequency = function(k1) {
      k1.incrementFrequency(word);
    }
    $scope.title = '';
    $scope.definition = '';
  };
}]);

app.controller('K2Ctrl', [
'$scope',
'k2',
function($scope, k2){
  
  $scope.words = k2.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    k2.create({
      title: $scope.title, 
      definition: $scope.definition, 
      frequency: 1
    });
    $scope.incrementFrequency = function(k2) {
      k2.incrementFrequency(word);
    }
    $scope.title = '';
    $scope.definition = '';
  };
}]);

app.controller('AWLCtrl', [
'$scope',
'awl',
function($scope, awl){
  
  $scope.words = awl.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    awl.create({
      title: $scope.title, 
      definition: $scope.definition, 
      frequency: 0
    });
    $scope.incrementFrequency = function(awl) {
      awl.incrementFrequency(word);
    }
    $scope.title = '';
    $scope.definition = '';
  };
}]);

app.controller('OfflistCtrl', [
'$scope',
'offlist',
function($scope, offlist){
  
  $scope.words = offlist.words;
  $scope.addWord = function() {
    if(!$scope.title || $scope.title === ''){ return; }
    offlist.create({
      title: $scope.title, 
      definition: $scope.definition, 
      frequency: 1
    });
    $scope.incrementFrequency = function(offlist) {
      offlist.incrementFrequency(word);
    }
    $scope.title = '';
    $scope.definition = '';
  };
}]);