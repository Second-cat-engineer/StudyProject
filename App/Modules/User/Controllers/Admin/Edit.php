<?php

namespace App\Modules\User\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\User;

class Edit extends AdminController
{
    protected function action()
    {
        $user = User::findById($_POST['id']);
        if (false === $user) {
            throw new Error404('Ошибка при редактировании! User с таким id не существует', 404);
        }
        $this->view->user = $user;
        $this->view->display(__DIR__ . '/../../templates/admin/edit.php');
    }
}