<?php
namespace Memory\Common\Config;

/**
 * @name Config
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Config
 * @abstract Extract .env datas to make variables available in the Application
 *
 */

use Dotenv\Dotenv;

class Environment
{

    public function __construct() {
        $dotEnv = Dotenv::createImmutable(__DIR__ . "/../../../config");
        $dotEnv->load();
    }
}

