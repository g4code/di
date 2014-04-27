<?php

namespace G4\DI;

class Container
{
    protected static $_container;

    public static function get($name)
    {
        if(null === self::$_container) {
            self::getInstance();
        }

        return self::$_container[$name];
    }

    public static function getInstance()
    {
        if(null === self::$_container) {
            self::$_container = new \Pimple();
        }

        return self::$_container;
    }
}