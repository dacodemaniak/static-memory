<?php
namespace Memory\Common\Reflection;

/**
 * @name ControllerIterator
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Reflection
 * @abstract Loop through Controller folder to get all defined controllers classes
 */
final class ControllerIterator {
    
    /**
     * Root directory where resides Controller Classes
     * 
     * @var string
     */
    private $rootDirectory = "";
    
    /**
     * Collection of controllers found
     * 
     * @var array
     */
    private $controllers;
    
    public function __construct() {
        $this->rootDirectory = __DIR__ . "/../../Controllers/";
        
        $this->controllers = [];
        
        $this->process();
    }
    
    public function get(): array {
        return $this->controllers;
    }
    
    /**
     * Loop over the Directory Iterator to get all node objects
     */
    private function process(): void {
        $iterator = new \DirectoryIterator($this->rootDirectory);
        
        foreach ($iterator as $nodeInfo) {
            if ($nodeInfo->isDot()) continue;
            
            $this->controllers[] = [
                "fileName" => $nodeInfo->getFilename(),
                "class" => "Memory\\Controllers\\" . $nodeInfo->getBasename(".php")
            ];
        }
    }
}

