<?php

namespace G4\DI;

use Pimple\Container as Pimple;

class Container extends Pimple
{

    /**
     * @var Container
     */
    protected static $instance;

    /**
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);
    }

    private function __clone() {}

    /**
     * Singleton
     *
     * @return Container
     */
    final public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Register service that will each time return new instance of it
     *
     * @param Callable $callable
     * @return mixed
     */
    public static function registerFactory($callable)
    {
        return self::getInstance()->factory($callable)(self::getInstance());
    }

    /**
     * Register service that will each time return the same instance of it
     *
     * @param Callable $callable
     * @return mixed
     */
    public static function registerShare($callable)
    {
        return self::reg($callable);
    }

    /**
     * Pimple facade
     *
     * @param Callable $callable
     * @return \Pimple\mixed
     */
    private static function reg($callable)
    {
        $id = debug_backtrace()[2]['function'];
        if (! self::getInstance()->offsetExists($id)) {
            self::getInstance()->offsetSet($id, $callable);
        }
        return self::getInstance()->offsetGet($id);
    }
}