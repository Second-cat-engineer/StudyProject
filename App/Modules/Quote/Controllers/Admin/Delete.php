<?php

namespace App\Modules\Quote\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\Quote;

class Delete extends AdminController
{
    protected function action()
    {
        $quote = Quote::findById($_POST['id']);

        if (false === $quote) {
            throw new Error404('Ошибка при удалении! Quote с таким id не существует', 404);
        }
        $quote->delete();

        header('Location: /admin/quote/all');
    }
}