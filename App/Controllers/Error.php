<?php

namespace App\Controllers;

class Error extends BaseController
{
    public function __construct(\Exception $error)
    {
        parent::__construct();
        $this->view->error = $error;
    }

    protected function action()
    {
        $this->view->twigDisplay('/App/templates/error.html', [
            'error' => $this->view->error,
            'user' => $this->view->user,
        ]);
    }
}