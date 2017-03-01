<?php

class Controller extends Core
{
    public function __construct()
    {
        return;
    }

    public function __destruct()
    {
        if ($this->view->content) {

            echo $this->view->renderLayout();
        }
    }

    public function redirect($url = NULL)
    {

        if (!$url) {

            $url = $_SERVER['PHP_SELF'];
        }

        header("location: {$url}");
    }
}
