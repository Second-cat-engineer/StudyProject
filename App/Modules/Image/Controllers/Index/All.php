<?php

namespace App\Modules\Image\Controllers\Index;

use App\Controllers\BaseController;
use App\Models\Image;

class All extends BaseController
{

    protected function action()
    {
        $images = Image::findAll();
        $this->view->twigDisplay('/App/Modules/Image/templates/index/images.html', [
            'images' => $images,
            'user' => $this->view->user,
        ]);
    }
}