// Cambios de URL para direccionar las peticiones correctamente.
var root = document.location.href.replace("/bundles/index.html#!/","");


var weather = angular.module('Weather', ['ngRoute', "ngResource", "ui.router"])
.constant("ROOT", root+"/api/")
.constant("APP_NAME", "Weather App");



/*weather.config(function($stateProvider, $urlRouterProvider) {

        $urlRouterProvider.otherwise("/");
         $stateProvider
            .state('weather-panel', {
                url: "/",
                views: {
                    "a" : {
                        templateUrl: "WeatherBundle/weatherPanel/weatherPanel.tpl.html"
                    }                    
                }
                
            })
            .state('estado2', {
                url: "/estado2",
                templateUrl: "plantilla2.html",
            })
            .state('estado3', {
                url: "/estado3",
                templateUrl: "plantilla3.html"
            }); 
    });*/
// configure our routes
/*weather
        .config(["$routeProvider",
                 "$locationProvider",
                 "$urlRouterProvider",
                 "$httpProvider", 
        function ($routeProvider) {
            $routeProvider
                // route for the home page
                .when('/', {
                    templateUrl: 'WeatherBundle/weatherPanel/weatherPanel.tpl.html'
                    , controller: 'WeatherCtrl'
                });
    }]);*/