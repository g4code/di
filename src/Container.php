<?php

namespace G4\DI;

use \Pimple;

class Container extends Pimple
{

    protected static $instance;

    public function __construct(array $values = array())
    {
        parent::__construct($values);
    }

    final public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public static function get($name)
    {
        return self::getInstance()[$name];
    }

    public static function has($name)
    {
        return self::getInstance()->offsetExists($name);
    }

    public static function register($callable)
    {
        return self::reg(debug_backtrace()[1]['function'], $callable);
    }

    public static function registerShare($callable)
    {
        return self::reg(debug_backtrace()[1]['function'], self::getInstance()->share($callable));
    }

    protected static function reg($id, $callable)
    {
        if (! self::getInstance()->offsetExists($id)) {
            self::getInstance()->offsetSet($id, $callable);
        }
        return self::getInstance()->offsetGet($id);
    }

    private function __clone() {}
}