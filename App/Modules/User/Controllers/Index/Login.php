<?php

namespace App\Modules\User\Controllers\Index;

use App\Components\Auth\Auth;
use App\Controllers\BaseController;
use App\Exceptions\MultiException;

class Login extends BaseController
{

    protected function action()
    {
        $identity = new Auth();
        try {
            $identity->authenticate($_POST);
            header('Location: /');
        } catch (MultiException $errors) {
            $this->view->twigDisplay('/App/Modules/User/templates/index/loginForm.html', [
                'user' => $this->view->user,
                'errors' => $errors->all(),
                'login' => $_POST['login'],
                'password' => $_POST['password'],
            ]);
        }
    }
}