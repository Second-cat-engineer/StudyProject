<?php

namespace App\Modules\Image\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use App\Models\Comment;
use App\Models\Image;

class One extends BaseController
{

    protected function action()
    {
        $recordId = $_GET['id'];
        if (empty($recordId) || !is_numeric($recordId)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $image = Image::findById($recordId);

        if (false === $image) {
            throw new Error404('Страница не найдена!', 404);
        }

        $moduleName = Image::TABLE;
        $comments = Comment::findByRecord($moduleName, $recordId);

        $this->view->twigDisplay('/App/Modules/Image/templates/index/image.html', [
            'image' => $image,
            'comments' => $comments,
            'user' => $this->view->user,
        ]);
    }
}