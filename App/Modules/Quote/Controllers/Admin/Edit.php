<?php

namespace App\Modules\Quote\Controllers\Admin;
use App\Controllers\AdminController;
use App\Exceptions\Error404;
use \App\Models\Quote;

class Edit extends AdminController
{
    protected function action()
    {
        $quote = Quote::findById($_POST['id']);
        if (false === $quote) {
            throw new Error404('Ошибка при редактировании! Quote с таким id не существует', 404);
        }
        $this->view->quote = $quote;
        $this->view->display(__DIR__ . '/../../templates/admin/edit.php');
    }

}