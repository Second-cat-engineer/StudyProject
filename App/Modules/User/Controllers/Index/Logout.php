<?php

namespace App\Modules\User\Controllers\Index;

use App\Components\Auth\Auth;
use App\Controllers\BaseController;

class Logout extends BaseController
{
    protected function action()
    {
        $identity = new Auth();
        $identity->logout();
        $this->view->twigDisplay('/App/Modules/User/templates/index/loginForm.html', [
            'user' => $this->view->user,
        ]);
    }
}