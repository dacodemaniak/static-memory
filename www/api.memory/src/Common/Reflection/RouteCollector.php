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
use Maslosoft\Addendum\Reflection\ReflectionAnnotatedClass;
use Maslosoft\Addendum\Reflection\ReflectionAnnotatedMethod;

final class RouteCollector {

    public function __construct() {
        $this->process();
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
                    echo "AltoRoute was found for " . $method->name . "<br>";
                } else {
                    echo "Unable to find Route for " . $method->name . "<br>";
                }
                
                /**
                // Check for annotations for the method
                $reflectionClassMethod = new ReflectionAnnotatedMethod($controller["class"], $method->name);
                
                var_dump($reflectionClassMethod->getAllAnnotations());
                
                if ($reflectionClassMethod->hasAnnotation("AltoRoute")) {
                    var_dump($reflectionClassMethod->getAnnotation("AltoRoute"));
                } else {
                    echo "No route found for " . $method->name . " in " . $controller["class"] . "<br>";
                }
                **/
            }
        }
        
    }
}

