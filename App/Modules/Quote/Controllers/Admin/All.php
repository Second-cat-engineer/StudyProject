<?php

namespace App\Modules\Quote\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\Quote;

class All extends AdminController
{

    protected function action()
    {
        $this->view->quotes = Quote::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/all.php');
    }
}