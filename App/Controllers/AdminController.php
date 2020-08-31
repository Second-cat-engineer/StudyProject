<?php

namespace App\Controllers;

use App\Components\Auth\Auth;
use \App\Components\View;
use App\Models\User;

abstract class AdminController
{
    protected $access;
    protected object $view;

    public function __construct()
    {
        $this->view = new View();

        $session = new Auth();
        if (null == $session->getCurrentUser()) {
            $this->access = null;
        } else {
            $this->access = User::findByLogin($session->getCurrentUser())->access;
        }
    }

    protected function access():bool
    {
        if ('admin' === $this->access) {
            return true;
        }
        return false;
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