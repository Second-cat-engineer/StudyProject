<?php

namespace App\Modules\User\Controllers\Index;

use App\Controllers\BaseController;

class RegistrationForm extends BaseController
{
    protected function action()
    {
        $this->view->twigDisplay('/App/Modules/User/templates/index/registrationForm.html', []);
    }
}