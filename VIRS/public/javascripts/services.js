//Angular Services

// Service for K1
app.factory('k1', ['$http',function($http){
    var o = {
        words: []
    };
    o.getAll = function() { //Querying the backend for all k1 words using the index route
        return $http.get('/k1').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };
    o.create = function(k1) {
        return $http.post('/k1', k1).success(function(data) {
            o.words.push(data);
        });
    };
    o.incrementFrequency = function (k1) {
        return $http.put('/k1/' + word._id + '/frequency').success(function(data){
            word.frequency += 1;
        });
    };
    return o;
}]);

// Service for AWL
app.factory('awl', ['$http',function($http){
    var o = {
        words: []
    };
    o.getAll = function() { //Querying the backend for all awl words using the index route
        return $http.get('/awl').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };
    o.create = function(awl) {
        return $http.post('/awl', awl).success(function(data) {
            o.words.push(data);
        });
    };
    o.incrementFrequency = function (awl) {
        return $http.put('/awl/' + word._id + '/frequency').success(function(data){
            word.frequency += 1;
        });
    };
    return o;
}]);