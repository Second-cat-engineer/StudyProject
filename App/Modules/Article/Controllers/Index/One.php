<?php

namespace App\Modules\Article\Controllers\Index;

use \App\Controllers\BaseController;
use App\Exceptions\Error404;
use \App\Models\Article;
use App\Models\Comment;
use App\Models\Module;

class One extends BaseController
{
    protected function action()
    {
        $recordId = $_GET['id'];
        if (empty($recordId) || !is_numeric($recordId)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $article = Article::findById($recordId);
        if (empty($article)) {
            throw new Error404('Страница не найдена!', 404);
        }

        $moduleName = Article::TABLE;
        $comments = Comment::findByRecord($moduleName, $recordId);

        $this->view->twigDisplay('/App/Modules/Article/templates/index/article.html', [
            'article' => $article,
            'comments' => $comments,
            'user' => $this->view->user,
        ]);
    }
}