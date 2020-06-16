<?php
namespace Memory\Controllers;

use Memory\Annotations\AltoRoute as AltoRoute;

class HallOfFame
{

    public function __construct() {
        
    }
    
    /**
     * @AltoRoute(
     *  path="/halloffame",
     *  name="all_halloffame"
     * )
     * 
     * Get all entries for the Hall of Fame entity
     */
    public function getAll(): array {
        return [];
    }
}

