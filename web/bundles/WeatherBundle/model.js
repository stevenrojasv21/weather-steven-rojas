weather
.factory("WeatherService", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "weather/:city", {
            city: "@city"
        });
    }
]);
