<?php

namespace App\Modules\Quote\Controllers\Index;

use App\Controllers\BaseController;
use App\Exceptions\Error404;
use App\Models\Comment;
use App\Models\Quote;

class One extends BaseController
{
    protected function action()
    {
        $recordId = $_GET['id'];
        if (empty($recordId) || !is_numeric($recordId)) {
            throw new Error404('Некорректно введены данные, страница не найдена!', 404);
        }

        $quote = Quote::findById($recordId);
        if (false === $quote) {
            throw new Error404('Страница не найдена!', 404);
        }

        $moduleName = Quote::TABLE;
        $comments = Comment::findByRecord($moduleName, $recordId);

        $this->view->twigDisplay('/App/Modules/Quote/templates/index/quote.html', [
            'quote' => $quote,
            'comments' => $comments,
            'user' => $this->view->user,
        ]);
    }
}