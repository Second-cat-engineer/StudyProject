<?php

namespace App\Modules\Article\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use \App\Models\Article;

class FindByHeading extends BaseController
{
    protected function action()
    {
        $heading_id = $_GET['heading_id'];
        if (empty($heading_id) || !is_numeric($heading_id)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $articles = Article::findByHeadingId($heading_id);

        if (empty($articles)) {
            throw new Error404('Страница не найдена!', 404);
        }
        $this->view->twigDisplay('/App/Modules/Article/templates/index/findByHeading.html', [
            'articles' => $articles,
            'user' => $this->view->user,
        ]);
    }
}