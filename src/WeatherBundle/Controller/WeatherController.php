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
   * @namespace  WeatherBundle\Controller 
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
        $url = "$base_endpoint?q=$city&appid=$appid&units=$units";
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        $statusCode = $res->getStatusCode();
        $response = $res->getBody();
        return new JsonResponse($response, $statusCode, array(), true);
    }
    
    /*
    * getCitiesAction
    *
    * This function returns the parametrized cities in the application.
    *
    * @return (JSON) Return a JSON String with the cities.
    */
    public function getCitiesAction() {
        return new JsonResponse($this->container->getParameter('cities'));
    }

}
