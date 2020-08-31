<?php

namespace App\Modules\Quote\Controllers\Admin;

use App\Controllers\AdminController;
use App\Exceptions\Error404;
use App\Exceptions\MultiException;
use App\Models\Quote;
use App\Models\User;

class Save extends AdminController
{

    protected function action()
    {
        if (empty($_POST['id'])) {
            $quote = new Quote();
        } else {
            $quote = Quote::findById($_POST['id']);
            if (false === $quote) {
                throw new Error404('Ошибка при сохранении! Статья с таким id не существует', 404);
            }
        }

        try {
            $quote->fill($_POST);
        } catch (MultiException $e) {
            $errors = $e->all();
            foreach ($errors as $error) {
                echo $error->getMessage();
            }
            exit();
        }

        $quote->author_id = User::findByLogin($_SESSION['userLogin'])->getId();
        $quote->save();
        header('Location: /admin/quote/all');
    }
}