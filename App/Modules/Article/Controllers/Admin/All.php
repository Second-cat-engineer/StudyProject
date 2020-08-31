<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;
use \App\Models\Article;

class All extends AdminController
{
    protected function action()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/all.php');
    }
}