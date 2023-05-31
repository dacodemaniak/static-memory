<?php
namespace Memory\Common\Http\Cors;

/**
 * CorsConfiguration
 * @author DaCoDeMaNiaK <jla.webprojet@gmail.com>
 * @version 1.0.0
 * 
 *  Cors headers configuration
 *  @see Memory\Common\Http\HttpResponse
 */
final class CorsConfiguration {
    public static function getCorsConfiguration(): array {
        return [
            'Access-Control-Allow-Origin' => '*'
        ];
    }
}