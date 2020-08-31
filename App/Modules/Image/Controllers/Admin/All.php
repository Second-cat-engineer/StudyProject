<?php

namespace App\Modules\Image\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\Image;

class All extends AdminController
{

    protected function action()
    {
        $this->view->images = Image::findAll();
        $this->view->display(__DIR__ . '/../../templates/admin/all.php');
    }
}