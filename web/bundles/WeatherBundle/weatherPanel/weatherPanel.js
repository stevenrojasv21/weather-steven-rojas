weather
.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'WeatherBundle/weatherPanel/weatherPanel.tpl.html'
            ,controller: 'WeatherCtrl'
            ,resolve: {
                $b: ["$q", "WeatherService",
                function ($q, WeatherService) {
                    return $q.all({
                        foo: WeatherService.query({city:'cities'}).$promise
                    });
                }]
        }
        })
    }
)        
.controller("WeatherCtrl", ['$scope','$http', '$q', '$location', 'WeatherService', WeatherCtrl]);

function WeatherCtrl($scope, $http, $q, $location, WeatherService)
{
    $scope.cities = WeatherService.query({city:'cities'});
    //Methods
    
    $scope.getCityWeather = function () {
        var data = WeatherService.get({city: $scope.select_city}).$promise;
        data.then(function(data) {
            $scope.information = data;
        });
    };
}
;