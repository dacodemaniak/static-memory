<?php
namespace Memory\Common\Http\Response;

/**
 * @name Response
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Abstract
 * @namespace Memory\Common\Http\Response
 * @abstract Guide Response type to send to server
 */

use Memory\Common\Http\Response\Response;
use Memory\Common\Http\Cors\CorsConfiguration;

abstract class HttpResponse implements Response {

    /**
     * Headers to send to server
     * @var array
     */
    protected $headers;
    
    /**
     * Content to send to webserver
     * @var mixed 
     */
    protected $content;
    
    /**
     * HttpStatus to send to webserver
     * @var int
     */
    protected $httpStatus;
    
    public function __construct($content, int $httpStatus=200){
        $this->content = $content;
        $this->httpStatus = $httpStatus;
    }
    
    /**
     * Send specified Http Headers, fallback to text/html if not
     */
    protected function sendHeaders() {
        $corsHeaders = CorsConfiguration::getCorsConfiguration();

        // Merge cors with existing headers
        foreach($corsHeaders as $header => $value) {
            if (!array_key_exists($header, $this->headers)) {
                $this->headers[$header] = $value;
            }
        }

        // Send response headers
        if ($this->headers && count($this->headers)) {
            foreach ($this->headers as $header => $content) {
                header($header . ": " . $content);
            }
        } else {
            header("Content-Type: text/html; charset=utf-8");
        }
    }
    
    abstract public function send(): void;
    
    abstract protected function setHeaders(): void;
}

