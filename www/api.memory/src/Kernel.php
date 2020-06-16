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
}

