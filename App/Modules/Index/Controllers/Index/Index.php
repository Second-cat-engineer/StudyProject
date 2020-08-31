<?php

namespace App\Modules\Index\Controllers\Index;;

use \App\Controllers\BaseController;
use App\Models\Article;

class Index extends BaseController
{
    protected function action()
    {
        //$articles = Article::findLastCount(3);
        $this->view->twigDisplay('/App/Modules/Index/templates/index/index.html', [
            'user' => $this->view->user,
        ]);
    }
}