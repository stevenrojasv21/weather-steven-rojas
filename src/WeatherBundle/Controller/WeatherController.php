<?php
/**
 * WeatherController.php
 * @author    Steven Rojas <stevenrojasv21@gmail.com>
 * @license   MIT License
 */
namespace WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

  /**
   * WeatherController
   * 
   * This class does requests to the Weather API and returns this information in JSON format.
   */

class WeatherController extends Controller {

    /*
    * showAction
    *
    * This function returns weather information about a City.
    *
    * @param (Request) Receive information about the request.
    * @param (String) Receive the city to search the information.
    * @return (JSON) Return a JSON String with the information.
    */
    public function showAction(Request $request, $city = 'New York') {
        $units = $request->query->get('units');
        if (is_null($units)) {
            $units = $this->container->getParameter('units');
        }
        $base_endpoint = $this->container->getParameter('base_endpoint');
        $appid = $this->container->getParameter('appid');
        //Validate if the city is into the array cities
        if (array_search(strtolower($city), array_map('strtolower', $this->container->getParameter('cities'))) === false) {
            return new JsonResponse('City Not Found', '404', array(), true);
        }
        $url = "$base_endpoint?q=$city&appid=$appid&units=$units";
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        $statusCode = $res->getStatusCode();
        $responseAPI = $res->getBody();
        $response = new JsonResponse($responseAPI, $statusCode, array(), true);
        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }
    
    /*
    * getCitiesAction
    *
    * This function returns the parametrized cities in the application.
    *
    * @return (JSON) Return a JSON String with the cities.
    */
    public function getCitiesAction() {
        $response = new JsonResponse($this->container->getParameter('cities'));
        // cache for 3600 seconds
        $response->setSharedMaxAge(3600);

        // (optional) set a custom Cache-Control directive
        $response->headers->addCacheControlDirective('must-revalidate', true);
        return $response;
    }

}
