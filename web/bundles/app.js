// Cambios de URL para direccionar las peticiones correctamente.
var root = document.location.href.replace("/bundles/index.html#!/","");

var weather = angular.module('Weather', ['ngRoute', "ngResource", "ui.router"])
.constant("ROOT", root+"/api/")
.constant("APP_NAME", "Weather App");