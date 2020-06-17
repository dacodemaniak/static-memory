<?php
namespace Memory\Common\ORM;

/**
 * @name EntityManager
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\ORM
 * @category ORM
 * @abstract Database Abstraction Layer based on Doctrine
 */

use \Doctrine\ORM\Tools\Setup as Setup;
use \Doctrine\ORM\EntityManager as DoctrineManager;
use Dotenv\Dotenv;

class EntityManager {

    /**
     * Static instance of that class
     */
    private static $instance;
    
    /**
     * @var array
     * Stores the pathes of entities, default src/Entities
     */
    private $entityPathes;
    
    /**
     * @var boolean
     * Determines wether Manager runs in dev mode or not
     */
    private $isDevMode = true;
    
    /**
     * Defines proxy directory for entities, default null
     * @var string
     */
    private $proxyDir = null;
    
    /**
     * Defines cache directory
     * @var string
     */
    private $cache = null;
    
    /**
     * Defines the annotation reader to use
     * @var boolean
     */
    private $useSimpleAnnotationReader = false;
    
    /**
     * Stores Database configuration and driver
     * @var array
     */
    private $dbConfiguration = [
        "driver" => "pdo_mysql",
        "host" => "localhost",
        "charset" => "utf8",
        "user" => "doctrine_dba",
        "password" => "doctrine",
        "dbname" => "doctrine" // CAUTION DO NOT USE CAMELCASE HERE
    ];
    
    /**
     * Doctrine Entity Manager
     * @var Doctrine\ORM\EntityManager
     */
    private $manager = null;
    
    /**
     * Private constructor of EntityManager Singleton
     */
    private function __construct() {
        $this->entityPathes = [
            join(DIRECTORY_SEPARATOR, [__DIR__, "..", "..", "Entity"])
        ];
        
        // Get DB configuration from $_ENV
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../../../config");
        $dotenv->load();
        
        $this->dbConfiguration["driver"] = $_ENV["DB_DRIVER"];
        $this->dbConfiguration["host"] = $_ENV["DB_HOST"];
        $this->dbConfiguration["charset"] = $_ENV["DB_CHARSET"];
        $this->dbConfiguration["user"] = $_ENV["DB_USER"];
        $this->dbConfiguration["password"] = $_ENV["DB_PASSWORD"];
        $this->dbConfiguration["dbname"] = $_ENV["DB_NAME"];
        
        // then... process
        $this->manager = $this->process();
    }
    
    /**
     * Main method for Singleton
     */
    public static function getEntityManager(): \Memory\Common\ORM\EntityManager {
        if (self::$instance === null) {
            self::$instance = new EntityManager();
        }
        
        return self::$instance;
    }
    
    /**
     * Returns Doctrine Entity Manager
     * @return Doctrine\ORM\EntityManager
     */
    public function getManager(): \Doctrine\ORM\EntityManager {
        return $this->manager;
    }
    
    public function getRepository($entityClassName) {
        return $this->manager->getRepository($entityClassName);
    }
    
    /**
     * Process the Doctrine Entity Manager Configuration and returns it
     * @return \Doctrine\ORM\EntityManager
     */
    private function process() {
        $config = Setup::createAnnotationMetadataConfiguration(
            $this->entityPathes,
            $this->isDevMode,
            $this->proxyDir,
            $this->cache,
            $this->useSimpleAnnotationReader
            );
        return DoctrineManager::create($this->dbConfiguration, $config);
    }
}

