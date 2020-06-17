<?php
/**
* @name cli-config.php
* @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
* @version 1.0.0
* @abstract Command Line Interface to work with Doctrine ORM
*/
require_once join(DIRECTORY_SEPARATOR, [__DIR__, "/../src/Common/ORM/EntityManager.php"]);

// Defines space name from where pick the ConsoleRunner class
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// Get the instance of my own EntityManager
$instance = \Memory\Common\ORM\EntityManager::getEntityManager();

// Finally returns the Helper that allow Doctrine CLI commands
return ConsoleRunner::createHelperSet($instance->getManager());