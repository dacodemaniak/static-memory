<?php
namespace Memory\Common\Reflection;

/**
 * @name RouteCollector
 * @author IDea Factory (jean-luc.aubert@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Reflection
 * @abstract Gather all controller routes to sets the router
 */
use Memory\Common\Reflection\ControllerIterator;
use Maslosoft\Addendum\Annotation;
use Memory\Annotations\AltoRoute as AltoRoute;

use AltoRouter;

final class RouteCollector {
    /**
     * Routes collection to feed AltoRouter class
     * @var array
     */
    private $routes = [];
    
    /**
     * Instance of AltoRouter
     * @var \AltoRouter
     */
    private $router;
    
    public function __construct() {
        $this->router = new \AltoRouter();
        
        $this->process();
    }
    
    /**
     * Return the Router hydrated from Controller annotations
     * @return \AltoRouter
     */
    public function getRouter(): \AltoRouter {
        return $this->router;
    }
    
    private function process(): void {
        $controllers = (new ControllerIterator())->get();
        foreach ($controllers as $controller) {
            // Get all public methods for the current controller
            $reflection = new \ReflectionClass($controller["class"]);
            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            
            foreach ($methods as $method) {
                if ($method->name === "__construct") continue;
                
                $reflectedMethod = new \Memory\Common\Annotations\ReflectedAnnotedMethod($controller["class"], $method->name);
                

                if ($reflectedMethod->hasAnnotation("AltoRoute")) {
                    $this->routes = $reflectedMethod->getAnnotation("AltoRoute");
                } else {
                    // @todo Replace with NoRouteFoundException
                    echo "Unable to find Route for " . $method->name . "<br>";
                }
            }
        }
        // Finally, build routes found
        foreach($this->routes as $route) {
            $this->router->map(
                $route->httpMethod,
                $route->path,
                $route->className . "#" . $route->classMethod,
                $route->name
            );
        }
    }
}

