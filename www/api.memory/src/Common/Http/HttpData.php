<?php
namespace Memory\Common\Http;

/**
 * @name HttpData
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @namespace Memory\Common\Http
 * @abstract Expose methods that must be implemented in Request classes
 *
 */
interface HttpData {
    public function get(string $data, string $value = null): string;
}

