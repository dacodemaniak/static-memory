<?php
namespace Memory\Common\Controller;

/**
 * @name CallableInterface
 * @author IDea Factory (jean-luc.a@ideafactory.fr)
 * @version 1.0.0
 * @category Interface
 * @abstract Define required controller methods
 */

use Memory\Common\Http\Response\Response;

 interface CallableInterface  {
     public function invoke(string $method, array $args): Response;
 }

