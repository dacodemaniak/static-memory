<?php
namespace Memory\Controllers;

/**
 * @name HallOfFame
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Controller
 * @abstract Handle routes for Hall Of Fame
 */

use Memory\Common\Controller\Controller;

class HallOfFame extends Controller {

    public function __construct() {
        
    }
    
    /**
     * @AltoRoute(
     *  path="/halloffame",
     *  name="all_halloffame"
     * )
     * 
     * Get all entries for the Hall of Fame entity
     * @todo change array return type to Response
     */
    public function getAll(): array {
        echo "HallOfFame::getAll() works!";
        return [];
    }
    
    /**
     * @AltoRoute(path="/halloffame", name="add_halloffame", method="POST")
     * 
     * @return array
     * @todo change array return type to Response
     */
    public function add(): array {
        return [];
    }
    
    /**
     * Override
     * 
     * @param string $method
     * @param array $args
     * 
     * @see Controller, CallableInterface
     */
    public function invoke(string $method, array $args): void {
        call_user_func_array([$this, $method], $args);
    }
}

