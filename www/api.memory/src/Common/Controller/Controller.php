<?php
namespace Memory\Common\Controller;

/**
 * @name Controller
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Abstract
 * @abstract Scheme class for controllers
 */

use Memory\Common\Controller\CallableInterface;

abstract class Controller  implements CallableInterface {

    public function __construct() {}

    abstract public function invoke(string $method, array $args): void;
}

