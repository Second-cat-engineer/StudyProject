<?php

namespace App\Components;

use App\Exceptions\Validation;

trait Validator
{
    protected function validator($prop, $value)
    {
        switch ($prop) {
            case 'title':
                if (empty($value)) {
                    throw new Validation('Заголовок не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            case 'comment':
                if (empty($value)) {
                    throw new Validation('Комментарий не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            case 'quote':
                if (empty($value)) {
                    throw new Validation('Цитата не должна быть пустым!');
                }
                return $this->$prop = $value;
                break;
            case 'content':
                if (empty($value)) {
                    throw new Validation('Текст не должен быть пустым!');
                }
                return $this->$prop = $value;
                break;
            default:
                return $this->$prop = $value;
        }
    }
}