<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * ProjectUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class ProjectUrlMatcher extends Symfony\Component\Routing\Matcher\UrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // index
        if ($pathinfo === '/') {
            return array (  '_controller' => 'IndexController:actionIndex',  '_route' => 'index',);
        }
        
        if ($pathinfo === '/index') {
            return array (  '_controller' => 'IndexController:actionIndex',  '_route' => 'index',);
        }

        // next page
        if ($pathinfo === '/next') {
            return array (  '_controller' => 'IndexController:actionNextPage',  '_route' => 'next',);
        }

        // create task
        if ($pathinfo === '/create') {
            return array (  '_controller' => 'IndexController:actionCreate',  '_route' => 'create',);
        }

        // upload image
        if ($pathinfo === '/upload') {
            return array (  '_controller' => 'IndexController:actionPreUploadImage',  '_route' => 'upload',);
        }

        // update text
        if ($pathinfo === '/save-text') {
            return array (  '_controller' => 'IndexController:actionSaveText',  '_route' => 'save-text',);
        }

        // change status task
        if ($pathinfo === '/success-task') {
            return array (  '_controller' => 'IndexController:actionSuccessTask',  '_route' => 'success-task',);
        }

        // change sort task
        if ($pathinfo === '/change-sort') {
            return array (  '_controller' => 'IndexController:actionChangeSort',  '_route' => 'change-sort',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            // login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'UserController:actionLogin',  '_route' => 'login',);
            }

            // logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'UserController:actionLogout',  '_route' => 'logout',);
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
