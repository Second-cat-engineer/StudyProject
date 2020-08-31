<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\Article;

class Delete extends AdminController
{
    protected function action()
    {
        $article = Article::findById($_POST['id']);
        if (false === $article) {
            throw new Error404('Ошибка при удалении! Статья с таким id не существует', 404);
        }
        $article->delete();

        header('Location: /admin/article/all');
    }
}