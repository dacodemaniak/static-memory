<?php
/**
* @name index.php
* @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
* @version 1.0.0
* @abstract Entry point of the Memory backend
*/

ini_set("display_errors", true);
error_reporting(E_ALL);

// Load composer class autoloader to avoid to have to require files manually
require_once("./../vendor/autoload.php");

// Imports classes
use Memory\Kernel;

// Instanciate a "Kernel" class to load everything we need to process API
$kernel = new Kernel();

// Process the current request
$response = $kernel->handleRequest();

// Finally send response to webserver