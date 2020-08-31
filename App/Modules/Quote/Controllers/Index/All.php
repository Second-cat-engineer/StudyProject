<?php

namespace App\Modules\Quote\Controllers\Index;

use App\Controllers\BaseController;
use App\Models\Quote;

class All extends BaseController
{

    protected function action()
    {
        $quotes = Quote::findAll();
        $this->view->twigDisplay('/App/Modules/Quote/templates/index/quotes.html', [
            'quotes' => $quotes,
            'user' => $this->view->user,
        ]);
    }
}