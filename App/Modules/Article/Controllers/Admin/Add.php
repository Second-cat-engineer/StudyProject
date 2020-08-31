<?php

namespace App\Modules\Article\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\Heading;

class Add extends AdminController
{
    protected function action()
    {
        $this->view->headings = Heading::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/add.php');
    }
}