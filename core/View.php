<?php

class View extends Core
{
    public function render($template)
    {
        if (! is_file($filename = __DIR__ . '/../application/view' . $template . '.php')) {

            return;
        }

        ob_start();
        include_once $filename;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function partial($template, $params = array())
    {
        $view = new View();

        foreach ($params as $k => $v) {

            $view->{$k} = $v;
        }

        return $view->render($template);
    }

    public function renderLayout()
    {
        if (! is_file($filename = __DIR__ . '/../application/view/layout.php')) {

            return;
        }

        ob_start();
        include_once $filename;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    final function __get($name)
    {
        if (! empty($this->{$name})) {

            return $this->{$name};
        }

        return;
    }
}
