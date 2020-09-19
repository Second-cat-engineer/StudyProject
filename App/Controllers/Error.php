<?php

namespace App\Controllers;

class Error extends BaseController
{
    protected function action()
    {
        $this->view->twigDisplay('/App/templates/error.html', [
            'user' => $this->view->user,
        ]);
    }
}