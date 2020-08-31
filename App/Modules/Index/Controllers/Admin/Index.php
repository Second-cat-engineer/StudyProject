<?php

namespace App\Modules\Index\Controllers\Admin;

use App\Controllers\AdminController;

class Index extends AdminController
{
    protected function action()
    {
        $this->view->display(__DIR__ . '/../../templates/admin/index.php');
    }
}