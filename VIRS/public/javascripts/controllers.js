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
'Upload', // From ng-file-upload
'$timeout', // From ng-file-upload
function($scope, k1, k2, offlist, awl, enhanced, Upload, $timeout){

  $scope.K1Words = k1.words;
  $scope.K2Words = k2.words;
  $scope.Offlist = offlist.words;
  $scope.AWL = awl.words;
  $scope.completeText = [{ word: String, color: String }];

  $scope.amountHighFrequency = k1.wordCount;
  $scope.amountMedFrequency = k2.wordCount; 
  $scope.amountLowFrequency = offlist.wordCount;
  $scope.amountAWLFrequency = awl.wordCount;

 // Method for implementing PDF Scan ------------------------------------------------
 var pdfToText = function(data) {
    	return PDFJS.getDocument(data).then(function(pdf) {
        	var pages = [];
        	for (var i = 0; i < pdf.numPages; i++) {
            	pages.push(i);
        	}
        	return Promise.all(pages.map(function(pageNumber) {
            	return pdf.getPage(pageNumber + 1).then(function(page) {
                	return page.getTextContent().then(function(textContent) {
                    	return textContent.items.map(function(item) {
                        	return item.str;
                    	}).join(' ');
                	});
            	});
        	})).then(function(pages) {
            	return pages.join("\r\n");
        	});
    	});
	}

/* ---------------------------------- Code for implementing file upload Begins ------------------------------------ */
  // Auxillary function for removing empty elements in array.
  var removeEmpty = function(word) { 
    return word != "";
  }
  /* ------------------ Using neg-file-upload.js -------------------*/
  $scope.uploadFiles = function(file, errFiles) { 
        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];
        if($scope.f.type != "application/pdf"){
          window.alert("ERROR: "+$scope.errFile.name +" is not of (file) " +$scope.errFile.$error+" type " + $scope.errFile.$errorParam);     
      }
      else {
        if (file) {
          console.log("application/pdf = "+$scope.f.type);
            var reader = new FileReader();
            reader.onload = function() {
                var typedarray = new Uint8Array(this.result);

                pdfToText(typedarray).then(function(result) {
                    result = result.replace(/[^a-zA-Z]/g," "); // Removing anything that is not a letter with regex
                    result = result.toLowerCase().split(" "); // Split into array of words(Strings)
                    result = result.filter(removeEmpty); // Remove empty array elements
                    $scope.pdfWords = result;
                    console.log("PDF done! Words in the PDF document: ");
                    for (var i = 0; i < $scope.pdfWords.length; i++) {
                      console.log(i +" "+$scope.pdfWords[i]);
                    }
                });	               
            }
            console.log("Reading:" + $scope.f.name +" Type:"+$scope.f.type);
            reader.readAsArrayBuffer($scope.f);
            reader.onerror = function (event) {
                console.error("File could not be read! Code "+ event.target.error.code);
            }
        }      
      }  
      $scope.text = $scope.pdfWords;
    }

  /* ---------------------------------- Code for implementing file upload Ends ------------------------------------ */

  // Auxillary functions to count amount of words in the text input by the user
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
  // Auxillary function to set content of enhanced words
  var setEnhancedText = function(words) {
    enhanced.setEnhanced(words);
  }

  // Auxillary functions for setting color
  var setHighColor = function() {
    for(var i = 0; i < $scope.completeText.length; i++){
      for(var j=0; j< k1.textWords.length; j++){
        if($scope.completeText[i].word === k1.textWords[j].words) {
          $scope.completeText[i].color = k1.textWords[j].color;
        }
      }
     }
  }

  var setMedColor = function() {
    for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< k2.textWords.length; j++){
        if($scope.completeText[i].word === k2.textWords[j].words) {
          $scope.completeText[i].color = k2.textWords[j].color;
        }
      }
     }
  }

  var setLowColor = function() {
    for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< offlist.textWords.length; j++){
        if($scope.completeText[i].word === offlist.textWords[j].words) {
          $scope.completeText[i].color = offlist.textWords[j].color;
        }
      }
     }
  }

  var setAWLColor = function() {
    for(var i = 0; i < $scope.textWords.length; i++){
      for(var j=0; j< awl.textWords.length; j++){
        if($scope.completeText[i].word === awl.textWords[j].words) {
          $scope.completeText[i].color = awl.textWords[j].color;
        }
      }
     }
  }

/* --------------- METHOD FOR TEXT BOX PROCESSING -------------------- */
  $scope.processText = function() { 

    console.log($scope.text + " "+ $scope.text.length); 
    $scope.textWords = $scope.text.toLowerCase().split(" ");

    for(var i = 0; i < $scope.textWords.length; i++){
      $scope.completeText.push({word: $scope.textWords[i], color:''});
     }

    countHighFreq($scope.textWords);
    countMedFreq($scope.textWords);
    countLowFreq($scope.textWords);
    countAWLFreq($scope.textWords);

/* Setting appropriate color for each word */
    
     setHighColor();
     setMedColor();
     setLowColor();
     setAWLColor();

    setEnhancedText($scope.completeText);
    console.log("Printing elements of the array completeText:");
    for(var i = 0; i < $scope.completeText.length; i++){
      console.log($scope.completeText[i]);
     }
  };

/* ----------------------- METHOD FOR PDF PROCESSING --------------------------- */
  $scope.processPDFText = function() { 
    $scope.textWords = $scope.pdfWords;

    for(var i = 0; i < $scope.textWords.length; i++){
      $scope.completeText.push({word: $scope.textWords[i], color:''});
     }
    countHighFreq($scope.textWords);
    countMedFreq($scope.textWords);
    countLowFreq($scope.textWords);
    countAWLFreq($scope.textWords);

/* Setting appropriate color for each word */
    setHighColor();
    setMedColor();
    setLowColor();
    setAWLColor();

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
'dictionary',
function($scope, k1, dictionary){
  
  $scope.text = k1.textWords;
  $scope.words = dictionary.high; // Acquiring data in the dictionary

  var definition = function() {
    for(var i = 0; i < $scope.text.length; i++) {
      dictionary.getHighData($scope.text[i].words); // Calling factory to push data only for the words in the list
    }
  }
  definition();
}]);

/* Contoller for Medium Frequency aka K2 page */
app.controller('K2Ctrl', [
'$scope',
'k2',
'dictionary',
function($scope, k2, dictionary){
  
  $scope.text = k2.textWords;
  $scope.words = dictionary.med; // Acquiring data in the dictionary

  var definition = function() {
    for(var i = 0; i < $scope.text.length; i++) {
      dictionary.getMedData($scope.text[i].words); // Calling factory to push data only for the words in the list
    }
  }
  definition();
  
}]);

/* Contoller for Low Frequency aka Offlist page */
app.controller('OfflistCtrl', [
'$scope',
'offlist',
'dictionary',
function($scope, offlist, dictionary){
  
  $scope.text = offlist.textWords;
  $scope.words = dictionary.low; // Acquiring data in the dictionary

  var definition = function() {
    for(var i = 0; i < $scope.text.length; i++) {
      dictionary.getLowData($scope.text[i].words); // Calling factory to push data only for the words in the list
    }
  }
  definition();
  
}]);

/* Contoller for Academic Word List page*/
app.controller('AWLCtrl', [
'$scope',
'awl',
'dictionary',
function($scope, awl, dictionary){
  
  $scope.text = awl.textWords;
  $scope.words = dictionary.awl; // Acquiring data in the dictionary

  var definition = function() {
    for(var i = 0; i < $scope.text.length; i++) {
      dictionary.getAWLData($scope.text[i].words); // Calling factory to push data only for the words in the list
    }
  }
  definition();

}]);

/* Contoller for Enhanced text page*/
app.controller('EnhancedCtrl', [
'$scope',
'enhanced',
function($scope, enhanced){

  $scope.texts = enhanced.textWords;

}]);