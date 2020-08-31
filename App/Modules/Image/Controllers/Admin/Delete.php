<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Models\Image;

class Delete extends AdminController
{
    protected function action()
    {
        $image = Image::findById($_POST['id']);
        if (false === $image) {
            throw new Error404('Ошибка при удалении! Image с таким id не существует', 404);
        }
        $image->delete();

        header('Location: /admin/image/all');
    }
}