<?php
namespace Memory\Common\Http\Response;

/**
 * @name JsonResponse
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Http
 * @namespace Memory\Common\Http\Response
 * @abstract Build JSON headers and send JSON response to the server
 *
 */

use Memory\Common\Http\Response\HttpResponse;

final class JsonResponse extends HttpResponse {

    public function __construct($content, int $httpStatus = 200){
        parent::__construct($content, $httpStatus);
        
        $this->setHeaders();
    }
    
    /**
     * @Override
     * 
     * @param mixed $content
     * 
     * Send the response and headers to webserver
     */
    public function send(): void {
        $this->sendHeaders();
        http_response_code($this->httpStatus); // Send the HTTP Status Code (default 200)
        
        echo json_encode($this->content);
    }
    
    
    /**
     * @Override
     *  Sets the headers to pass through CORS restriction and to send the correct MIME type
     */
    protected function setHeaders(): void {
        $this->headers["Access-Control-Origin"] = "*";
        $this->headers["Content-Type"] = "application/json; charset=utf-8";
    }
}

