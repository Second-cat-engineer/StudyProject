<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Controllers\AdminController;

class Add extends AdminController
{

    protected function action()
    {
        $this->view->display(__DIR__ . '/../../templates/admin/add.php');
    }
}