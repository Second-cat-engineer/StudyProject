<?php

namespace App\Controllers;

use App\Components\Auth\Auth;
use \App\Components\View;
use App\Models\User;

abstract class BaseController
{
    protected object $view;

    public function __construct()
    {
        $this->view = new View();

        $session = new Auth();
        if (null == $session->getCurrentUser()) {
            $this->view->user = null;
        } else {
            $this->view->user = User::findByLogin($session->getCurrentUser());
        }
    }

    protected function access():bool
    {
        return true;
    }

    public function __invoke()
    {
        if (!$this->access()) {
            die('Доступ закрыт');
        }
        $this->action();
    }

    abstract protected function action();
}