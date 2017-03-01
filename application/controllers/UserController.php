<?php

namespace controllers;

use models\User;

class UserController extends \Controller {

    public function actionLogin() {
        $modelUser = new User();
        $this->view->noNav = 'true';

        if (!empty($_POST)) {

            if ($modelUser->load() && $modelUser->triggers() && $user = $modelUser->find()
            ) {

                unset($user->password);
                $this->request->session_set('user', $user);

                return $this->redirect('/');
            } else {

                $this->view->email = $modelUser->getValues('email');
                $this->view->errors = $modelUser->getErrors();
            }
        }

        $this->view->content = $this->view->render('/user/login');

        return;
    }

    public function actionLogout() {
        $this->request->session_destroy();

        return $this->redirect('/');
    }

}
