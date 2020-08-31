<?php

namespace App\Modules\Image\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use App\Models\Image;

class One extends BaseController
{

    protected function action()
    {
        $id = $_GET['id'];
        if (empty($id) || !is_numeric($id)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $image = Image::findById($id);

        if (false === $image) {
            throw new Error404('Страница не найдена!', 404);
        }

        $this->view->twigDisplay('/App/Modules/Image/templates/index/image.html', [
            'image' => $image,
            'user' => $this->view->user,
        ]);
    }
}