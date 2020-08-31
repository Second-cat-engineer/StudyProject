<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Exceptions\MultiException;
use App\Models\Image;

class SaveEditImage extends AdminController
{
    protected function action()
    {
        $image = Image::findById($_POST['id']);
        if (false === $image) {
            throw new Error404('Ошибка при сохранении! Image с таким id не существует', 404);
        }

        try {
            $image->fill($_POST);
        } catch (MultiException $e) {
            $errors = $e->all();
            foreach ($errors as $error) {
                echo $error->getMessage();
            }
            exit();
        }

        $image->save();
        header('Location: /admin/image/all');
    }
}