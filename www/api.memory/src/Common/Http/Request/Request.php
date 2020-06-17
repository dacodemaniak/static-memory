<?php
namespace Memory\Common\Http\Request;

use Memory\Common\Http\Request\HttpQueryString;
use Memory\Common\Http\Request\HttpPost;
use Memory\Common\Http\Request\HttpBody;
/**
 * @name Request
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Http\Request
 * @abstract Extract client http request datas
 *
 */
class Request {
    /**
     * Http Request instance
     * @var Request
     */
    private static $request = null;
    
    /**
     * Query string datas
     * @see $_GET
     * 
     * @var HttpQueryString
     */
    public $query;
    
    /**
     * Posted datas
     * @see $_POST
     * 
     * @var HttpPost
     */
    public $post;
    
    /**
     * Request body
     * @var HttpBody
     */
    public $body;
    
    /**
     * Private constructor to avoid direct instanciation
     */
    private function __construct() {
       // Gets http request datas
       $this->query = new HttpQueryString;
       $this->post = new HttpPost();
       $this->body = new HttpBody();
    }
    
    /**
     * Process Http Client Request instanciation
     * 
     * @return Request
     */
    public static function create(): Request {
        if (self::$request === null) {
            // Make Request class instanciation
            self::$request = new Request();
        }
        return self::$request;
    }
}

