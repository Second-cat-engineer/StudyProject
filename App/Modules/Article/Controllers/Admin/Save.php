<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Exceptions\MultiException;
use App\Models\Article;
use App\Models\User;

class Save extends AdminController
{
    protected function action()
    {
        if (empty($_POST['id'])) {
            $article = new Article();
        } else {
            $article = Article::findById($_POST['id']);
            if (false === $article) {
                throw new Error404('Ошибка при сохранении! Статья с таким id не существует', 404);
            }
        }

        try {
            $article->fill($_POST);
        } catch (MultiException $e) {
            $errors = $e->all();
            foreach ($errors as $error) {
                echo $error->getMessage();
            }
            exit();
        }

        $article->author_id = User::findByLogin($_SESSION['userLogin'])->getId();
        $article->save();
        header('Location: /admin/article/all');
    }
}