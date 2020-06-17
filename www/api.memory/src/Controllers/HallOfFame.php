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
use Memory\Common\Http\Response\Response;
use Memory\Common\Http\Response\JsonResponse;
use Memory\Service\GamerService;
use Memory\Common\Http\Request\Request;
use Memory\Entity\Gamer;

class HallOfFame extends Controller {

    /**
     * Service for Gamer entity management
     * @var Memory\Service\GamerService
     * 
     * @todo Better inject the service in the Constructor method
     */
    private $gamerService;
    
    public function __construct() {
        $this->gamerService = new GamerService();
    }
    
    /**
     * @AltoRoute(
     *  path="/halloffame",
     *  name="all_halloffame"
     * )
     * 
     * Get all entries for the Hall of Fame entity
     * @return Response
     */
    public function getAll(): Response {
        
        return new JsonResponse(
            $this->gamerService->all()
        );
    }
    
    /**
     * @AltoRoute(path="/halloffame", name="add_halloffame", method="POST")
     * 
     * @return Response
     */
    public function add(Request $request): Response {
        $gamer = new Gamer();
        $gamer->setName($request->body->get("name"));
        
        $gamer = $this->gamerService->save($gamer);
        
        return new JsonResponse(
            [
                "message" => "Player was added",
                "payload" => [
                    "id" => $gamer->getId(),
                    "name" => $gamer->getName()
                ]
            ]
        );
    }
    
    /**
     * Override
     * 
     * @param string $method
     * @param array $args
     * 
     * @see Controller, CallableInterface
     */
    public function invoke(string $method, array $args): Response {
        return call_user_func_array([$this, $method], $args);
    }
}

