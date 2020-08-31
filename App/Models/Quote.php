<?php

namespace App\Models;

use App\Components\Validator;
use App\Exceptions\Validation;

/**
 * Class Quote
 * @property $id
 * @property string $quote
 * @property string $content
 * @property $created_at
 * @property object $author
 */
class Quote extends Model
{
    public const TABLE = 'quotes';

    use Validator;

    public function __get($name)
    {
        switch ($name) {
            case 'author':
                return User::findById($this->author_id);
                break;
            default:
                return null;
        }
    }

    public function __isset($name)
    {
        switch ($name) {
            case 'author':
                return !empty($this->author_id);
                break;
            default:
                return null;
        }
    }
}