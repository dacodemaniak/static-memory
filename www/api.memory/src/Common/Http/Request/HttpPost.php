<?php
namespace Memory\Common\Http\Request;

/**
 * @name HttpPost
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Http
 * @see Memory\Common\Http\HttpData
 */

use Memory\Common\Http\HttpData;


class HttpPost implements HttpData
{
    /**
     * QueryString parsed datas
     * @var array
     */
    private $datas;
    
    public function __construct() {
        $this->datas = [];
        $this->process();
    }
    
    /**
     * @Override
     * 
     * @param string $data
     * @param string $value
     * @return string
     */
    public function get(string $data, string $value = null): string {
        if (array_key_exists($data, $this->datas)) {
            return $this->datas[$data];
        }
        
        if ($value !== null) {
            $this->datas[$data] = $value;
            return $value;
        }
        
        return null;
        
    }
    
    /**
     * Process built-in $_POST array to get user posted values
     */
    private function process(): void {
        foreach($_POST as $data => $value) {
            $this->datas[$data] = $value;
        }
    }
}

