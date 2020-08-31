<?php

namespace App\Modules\Comment\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\MultiException;
use App\Models\Comment;
use App\Models\User;

class Add extends BaseController
{
    protected function action()
    {
        $textComment = $_POST['comment'];
        $controllerName = $_POST['controller'];
        $recordId = $_POST['recordId'];
        $moduleName = $_POST['moduleName'];

        if (!$this->view->user) {
            header('Location: /' . $controllerName . '/one/?id=' . $recordId);
            exit();
        }

        $errors = new MultiException();
        if (empty($textComment)) {
            $errors->add(new \Exception('Комментарий не может быть пустым'));
        }
        if (empty($recordId)) {
            $errors->add(new \Exception('некорректный id записи'));
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        $comment = new Comment();
        $comment->comment = $textComment;
        $comment->record_id = $recordId;
        $comment->author_id = $this->view->user->getId();
        $comment->module = $moduleName;

        $comment->saveComment();
        header('Location: /' . $controllerName . '/one/?id=' . $recordId);
    }
}