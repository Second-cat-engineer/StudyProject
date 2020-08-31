<?php

namespace App\Modules\User\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\User;

class All extends AdminController
{

    protected function action()
    {
        $this->view->users = User::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/all.php');
    }
}