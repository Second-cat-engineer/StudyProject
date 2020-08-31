<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Components\Uploader;
use App\Controllers\AdminController;
use App\Exceptions\MultiException;
use App\Models\Image;

class SaveNewImage extends AdminController
{
    protected function action()
    {
        $image = new Image();

        try {
            $image->fill($_POST);
        } catch (MultiException $e) {
            $errors = $e->all();
            foreach ($errors as $error) {
                echo $error->getMessage();
            }
            exit();
        }

        $upload = new Uploader($_FILES);
        try {
            $upload->upload();
        } catch (\App\Exceptions\Uploader $exception) {
            echo $exception->getMessage();
        }

        $image->path = $upload->pathImage;
        $image->save();
        header('Location: /admin/image/all');
    }
}