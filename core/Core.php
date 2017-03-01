<?php

class Core
{
    private $classes = [
        'routes'     => 'Routes',
        'config'     => 'Config',
        'db'         => 'Db',
        'request'    => 'Request',
        'security'   => 'Security',
        'view'       => 'View',
        'controller' => 'Controller',
        'turbosms'   => 'Turbosms',
    ];

    private static $objects = [];
    private static $_instance;

    public function __construct()
    {
    }

    public static function get()
    {
        if (NULL === self::$_instance) {

            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __get($name)
    {
        if (isset(self::$objects[$name])) {

            return (self::$objects[$name]);
        }

        if (!array_key_exists($name, $this->classes)) {

            return NULL;
        }

        $class = $this->classes[$name];

        self::$objects[$name] = new $class();

        return self::$objects[$name];
    }
}