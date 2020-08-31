<?php

namespace App\Models;

use App\Components\Validator;
use App\Exceptions\Validation;
use App\Models\User;

/**
 * Class Image
 * @property $id
 * @property string $title
 * @property string $content
 * @property string $path
 * @property int $author_id
 * @property $created_at
 * @property object $author
 */
class Image extends Model
{
    public string $path;
    public const TABLE = 'images';

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