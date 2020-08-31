<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\Image;

class Edit extends AdminController
{

    protected function action()
    {
        $image = Image::findById($_POST['id']);
        if (false === $image) {
            throw new Error404('Ошибка при редактировании! Quote с таким id не существует', 404);
        }
        $this->view->image = $image;
        $this->view->display(__DIR__ . '/../../templates/admin/edit.php');
    }
}