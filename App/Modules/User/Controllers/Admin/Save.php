<?php

namespace App\Modules\User\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\User;

class Save extends AdminController
{
    protected function action()
    {
        $user = User::findById($_POST['id']);
        if (false === $user) {
            throw new Error404('Ошибка при сохранении! User с таким id не существует', 404);
        }
        $user->access = $_POST['access'];

        $user->updateAccess();
        header('Location: /admin/user/all');
    }
}