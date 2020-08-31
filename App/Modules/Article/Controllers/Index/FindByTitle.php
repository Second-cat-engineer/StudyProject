<?php

namespace App\Modules\Article\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use \App\Models\Article;

class FindByTitle extends BaseController
{
    protected function action()
    {
        $title = $_POST['title'];
        $articles = Article::findByTitle($title);

        if (empty($articles)) {
            throw new Error404('Статьи с таким заголовком не найдены!', 404);
        }
        $this->view->twigDisplay('/App/Modules/Article/templates/index/findByTitle.html', [
            'articles' => $articles,
            'user' => $this->view->user,
        ]);
    }
}