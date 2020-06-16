<?php
namespace Memory;

/**
 * @name Kernel
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory
 * @abstract Application loader
 */

use Memory\Common\Config\Environment;
use Memory\Common\Http\Request\Request;
use Memory\Common\Reflection\RouteCollector;

use AltoRouter;

final class Kernel
{
    /**
     * Http Request Object
     * @var Memory\Common\Http\Request\Request
     */
    private $request;
    
    /**
     * Instance of the Router that handle routes
     * @var \AltoRouter
     */
    private $router;
    
    /**
     * Initiate the Kernel class
     */
    public function __construct() {
        new Environment(); // Load environment variables
        
        $this->request = Request::create(); // Process Client HttpRequest
        
        // Load routes from Controllers
        
        $collector = new RouteCollector();
        $this->router = $collector->getRouter();
    }
    
    public function handleRequest(): ?Response {
        $matchingRequest = $this->router->match();
        
        if ($matchingRequest) {
            $parseTarget = explode("#", $matchingRequest["target"]);
            $controllerName = $parseTarget[0]; // Target found
            $controllerMethod = $parseTarget[1];
            $params = $matchingRequest["params"]; // Params to pass to
            $name = $matchingRequest["name"];
            
            
            // Make an instance of the controller
            $controller = new $controllerName();
            // Invoke the correct controller method
            $controller->invoke(
                $controllerMethod,
                array_values($params) // if ever params
            );
            
        } else {
            echo "No routes match the request!";
        }
        
        return null;
        
        // @todo Throw an NoMatchingRouteFound
    }
}

