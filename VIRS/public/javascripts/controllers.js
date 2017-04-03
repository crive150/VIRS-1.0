// Angular Controllers

/* Contoller for Landing page */
app.controller('HomeCtrl', [
'$scope',
function($scope){
}]);

/* Contoller for Landing page */
app.controller('MainCtrl', [
'$scope',
'k1',
'k2',
'offlist',
'awl',
'enhanced',
function($scope, k1, k2, offlist, awl, enhanced){

  $scope.K1Words = k1.words;
  $scope.K2Words = k2.words;
  $scope.Offlist = offlist.words;
  $scope.AWL = awl.words;
  $scope.completeText = [{ word: String, color: String }];

  // Counts amount of K1/High-Frequency words in the text input by the user
  var countHighFreq = function(words) {
    k1.countHighFreq(words);
    $scope.amountHighFrequency = k1.wordCount;
  }

  var countMedFreq = function(words) {
    k2.countMedFreq(words); 
    $scope.amountMedFrequency = k2.wordCount;
  }
  var countLowFreq = function(words) {
    offlist.countLowFreq(words);
    $scope.amountLowFrequency = offlist.wordCount;
  }
  
  var countAWLFreq = function(words) {  
    awl.countAWLFreq(words);
    $scope.amountAWLFrequency = awl.wordCount;
  }

  var setEnhancedText = function(words) {
    enhanced.setEnhanced(words);
  }

  $scope.processText = function() { 

    console.log($scope.text + " " + $scope.text.length); 
    $scope.textWords = $scope.text.toLowerCase().split(" ");

    for(var i = 0; i < $scope.textWords.length; i++){
      $scope.completeText.push({word: $scope.textWords[i], color:''});
     }

    countHighFreq($scope.textWords);
    countMedFreq($scope.textWords);
    countLowFreq($scope.textWords);
    countAWLFreq($scope.textWords);

/* Setting appropriate color for each word */
    for(var i = 0; i < $scope.completeText.length; i++){
      for(var j=0; j< k1.textWords.length; j++){
        if($scope.completeText[i].word === k1.textWords[j].words) {
          $scope.completeText[i].color = k1.textWords[j].color;
        }
      }
     }

     for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< k2.textWords.length; j++){
        if($scope.completeText[i].word === k2.textWords[j].words) {
          $scope.completeText[i].color = k2.textWords[j].color;
        }
      }
     }

     for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< offlist.textWords.length; j++){
        if($scope.completeText[i].word === offlist.textWords[j].words) {
          $scope.completeText[i].color = offlist.textWords[j].color;
        }
      }
     }

     for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< awl.textWords.length; j++){
        if($scope.completeText[i].word === awl.textWords[j].words) {
          $scope.completeText[i].color = awl.textWords[j].color;
        }
      }
     }

    setEnhancedText($scope.completeText);

    console.log("Printing elements of the array completeText:");
    for(var i = 0; i < $scope.completeText.length; i++){
      console.log($scope.completeText[i]);
     }
  };

}]);

/* Contoller for High Frequency aka K1 page */
app.controller('K1Ctrl', [
'$scope',
'k1',
function($scope, k1){
  
  $scope.text = k1.textWords;
  
}]);

/* Contoller for Medium Frequency aka K2 page */
app.controller('K2Ctrl', [
'$scope',
'k2',
function($scope, k2){
  
  $scope.text = k2.textWords;
  
}]);

/* Contoller for Low Frequency aka Offlist page */
app.controller('OfflistCtrl', [
'$scope',
'offlist',
function($scope, offlist){
  
  $scope.text = offlist.textWords;
  
}]);

/* Contoller for Academic Word List page*/
app.controller('AWLCtrl', [
'$scope',
'awl',
function($scope, awl){
  
  $scope.text = awl.textWords;

}]);

/* Contoller for Enhanced text page*/
app.controller('EnhancedCtrl', [
'$scope',
'enhanced',
function($scope, enhanced){

  $scope.texts = enhanced.textWords;

}]);