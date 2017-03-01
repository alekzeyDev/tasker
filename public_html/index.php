<?php

session_start();

require_once(__DIR__ . '/../vendor/autoload.php');

class Index extends Core
{
    public function init() {

        $this->routes->init();
    }
}

(new Index())->init();

