<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class Routes extends Core
{
    public $router;
    public $params;

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */

    public function getParams()
    {
        return $this->params;
    }

    public function init()
    {
        try {
            $locator = new FileLocator([__DIR__ . '/../config']);
            $requestContext = new RequestContext('/');

            $this->router = new Router(
                new YamlFileLoader($locator),
                'routing.yaml',
                ['cache_dir' => __DIR__ . '/../cache/routing'],
                $requestContext
            );

            $this->params = $this->router->matchRequest(Request::createFromGlobals());

            list($controller, $action) = explode(":", $this->params['_controller']);

            $controller = "controllers\\$controller";

            call_user_func_array([(new $controller), $action], $this->params);

        } catch(Exception $e) {

            $controller = "controllers\\IndexController";

            call_user_func_array([(new $controller), "actionNotFound"], []);
        }
    }
}
