//Angular Services

// Service for K1 aka High Frequency words
app.factory('k1', ['$http',function($http){
    var o = {
        words: [],
        textWords: [{words: '', color: ''}],
        wordCount: 0
    };

    o.getAll = function() { //Querying the backend for all k1 words using the index route
        return $http.get('/k1').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };

    // Counts amount of K1/High-Frequency words in the text input by the user
    o.countHighFreq = function(words) {
        o.wordCount = 0;
        o.textWords = [];
        // Scanning text and comparing with K1
        for( var i = 0; i < o.words.length; i++ ){ // Array holding all high freq words
            for( var j = 0; j < words.length; j++ ){ // Array holding text inputted by user
                if(o.words[i].word === words[j]) {
                    o.wordCount++;
                    o.textWords.push({words: o.words[i].word, color: 'high'});
                }
            }
        }
    };

    return o;
}]);

// Service for K2 aka Medium Frequency words
app.factory('k2', ['$http',function($http){
    var o = {
        words: [],
        textWords: [{words: '', color: ''}],
        wordCount: 0
    };
    o.getAll = function() { //Querying the backend for all k2 words using the index route
        return $http.get('/k2').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };

    // Counts amount of K2/Medium-Frequency words in the text input by the user
    o.countMedFreq = function(words) {
        o.wordCount = 0;
        o.textWords = [{words: '', color: ''}];
        for( var i = 0; i < o.words.length; i++ ){ // Array holding all medium freq words
            for( var j = 0; j < words.length; j++ ){ // Array holding text inputted by user
                //console.log(o.words[i].word);
                if(o.words[i].word === words[j]) {
                    //console.log(o.words[i].word + " = "+ words[j]);
                    o.wordCount++;
                    o.textWords.push({words: o.words[i].word, color: 'med'});
                }
            }
        }
    };

    return o;
}]);

// Service for Offlist aka Low Frequency words
app.factory('offlist', ['$http',function($http){
    var o = {
        words: [],
        textWords: [{words: '', color: ''}],
        wordCount: 0
    };
    o.getAll = function() { //Querying the backend for all offlist words using the index route
        return $http.get('/offlist').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };

    o.countLowFreq = function(words) {
        o.wordCount = 0;
        o.textWords = [];
        for( var i = 0; i < o.words.length; i++ ){ // Array holding all low freq words
            for( var j = 0; j < words.length; j++ ){ // Array holding text inputted by user
                if(o.words[i].word === words[j]) {
                    o.wordCount++;
                    o.textWords.push({words: o.words[i].word, color: 'low'});
                }
            }
        }
    };

    return o;
}]);

// Service for AWL
app.factory('awl', ['$http',function($http){
    var o = {
        words: [],
        textWords:[{words: '', color: ''}],
        wordCount: 0     
    };

    o.getAll = function() { //Querying the backend for all awl words using the index route
        return $http.get('/awl').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };

    o.countAWLFreq = function(words) {
        o.wordCount = 0;
        o.textWords = [];
        for( var i = 0; i < o.words.length; i++ ){ // Array holding all awl words
            for( var j = 0; j < words.length; j++ ){ // Array holding text inputted by user  
                if(o.words[i].word === words[j]) {
                    o.wordCount++;
                    o.textWords.push({words: o.words[i].word, color: 'awl'});
                }
            }
        }
    };
    return o;
}]);

// Service for Enhanced Text
app.factory('enhanced', ['$http',function($http){
    var o = {
        textWords:[{words: '', color: ''}],
        wordCount: 0   
    };

    o.setEnhanced = function(words) {
        o.wordCount = 0;
        o.textWords = [];

        for( var j = 0; j < words.length; j++ ){ // Array holding text inputted by user
            o.wordCount++;
            o.textWords.push({words: words[j], color: words[j].color});               
        }
    };

    return o;
}]);

app.factory('dictionary', ['$http',function($http){
    var o = { 
        high: [],
        med: [],
        low:[],
        awl:[] 
    };

    o.reset = function() {
        o.high = [];
        o.med = [];
        o.low = [];
        o.awl = [];
    };

    o.getHighData = function(word) {
        //console.log("Looking for DEFINITION for word: " + word);
        return $http.get('/dictionary/' + word).then(function(res){
            o.high.push({theword: word, wordtype:res.data.wordtype, definition:res.data.definition});
        });
    };

    o.getMedData = function(word) {
        return $http.get('/dictionary/' + word).then(function(res){
            o.med.push({theword: word, wordtype:res.data.wordtype, definition:res.data.definition});
        });
    };

    o.getLowData = function(word) {
        return $http.get('/dictionary/' + word).then(function(res){
            o.low.push({theword: word, wordtype:res.data.wordtype, definition:res.data.definition});
        });
    };

    o.getAWLData = function(word) {
        return $http.get('/dictionary/' + word).then(function(res){
            o.awl.push({theword: word, wordtype:res.data.wordtype, definition:res.data.definition});
        });
    };

    return o;
}]);
