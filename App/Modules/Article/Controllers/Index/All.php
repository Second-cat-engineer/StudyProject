<?php

namespace App\Modules\Article\Controllers\Index;

use \App\Controllers\BaseController;
use \App\Models\Article;

class All extends BaseController
{
    protected function action()
    {
        $articles = Article::findAllEach();
        $this->view->twigDisplay('/App/Modules/Article/templates/index/articles.html', [
            'articles' => $articles,
            'user' => $this->view->user,
        ]);
    }
}