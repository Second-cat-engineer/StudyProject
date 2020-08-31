<?php

namespace App\Modules\User\Controllers\Index;

use App\Controllers\BaseController;

class LoginForm extends BaseController
{
    protected function action()
    {
        $this->view->twigDisplay('/App/Modules/User/templates/index/loginForm.html', []);
    }
}