<?php

namespace App\Modules\Comment\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Models\Comment;

class AllOfRecord extends AdminController
{

    protected function action()
    {
        $data = !empty($_POST) ? $_POST : $_GET;

        $modelName = 'App\Models\\' .  ucfirst($data['modelName']);
        $recordId = $data['recordId'];

        if (empty($recordId) || !is_numeric($recordId)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $this->view->modelName = $modelName::findById($recordId);
        if (empty($this->view->modelName)) {
            throw new Error404('Страница не найдена!', 404);
        }

        $moduleName = $modelName::TABLE;
        $this->view->controller = $data['modelName'];
        $this->view->comments = Comment::findByRecord($moduleName, $recordId);
        $this->view->display(__DIR__ . '/../../templates/admin/commentOfRecord.php');
    }
}