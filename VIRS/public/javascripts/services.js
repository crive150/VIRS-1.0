//Angular Services

app.factory('k1', ['$http',function($http){
    var o = {
        words: []
    };
    o.getAll = function() { //Querying the backend for all k1 words using the index route
        return $http.get('/k1').success(function(data){ 
            angular.copy(data, o.words) //Deep copy of returned data to keep the $scope data updated
        });
    };
    return o;
}]);