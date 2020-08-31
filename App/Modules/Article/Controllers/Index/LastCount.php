<?php

namespace App\Modules\Article\Controllers\Index;

use \App\Controllers\BaseController;
use \App\Models\Article;

class LastCount extends BaseController
{
    protected function action()
    {
        //доделать чтоб можно было передавать число в качестве аргумента!
        $count = 3;
        $articles = Article::findLastCount($count);
        $this->view->twigDisplay('/App/Modules/Article/templates/index/articles.html', [
            'articles' => $articles,
            'user' => $this->view->user,
        ]);
    }
}