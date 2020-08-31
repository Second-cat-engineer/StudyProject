<?php

namespace App\Modules\Comment\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Models\Comment;

class Delete extends AdminController
{

    protected function action()
    {
        $comment = Comment::findById($_POST['commentId']);
        $comment->delete();

        header('Location: /admin/comment/allOfRecord/?modelName=' .
            $_POST['modelName'] . '&recordId=' . $_POST['recordId']);
    }
}