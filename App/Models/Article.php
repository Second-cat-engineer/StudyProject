<?php

namespace App\Models;

use App\Components\Db;
use App\Components\Validator;
use App\Exceptions\Validation;

/**
 * Class Article
 * @property $id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property int $heading_id
 * @property object $author
 */
class Article extends Model
{
    public const TABLE = 'articles';

    use Validator;

    public function __get($name)
    {
        switch ($name) {
            case 'author':
                return User::findById($this->author_id);
                break;
            case 'heading':
                return Heading::findById($this->heading_id);
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
            case 'heading':
                return !empty($this->heading_id);
                break;
            default:
                return null;
        }
    }

    public static function findByHeadingId($heading_id)
    {
        $param[':heading_id'] = $heading_id;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE heading_id=:heading_id';
        $res = $db->query($sql, static::class, $param);
        if (empty($res)) {
            return false;
        }
        return $res;
    }

    public static function findByTitle($title)
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE title LIKE \'%' . $title . '%\'';
        $res = $db->query($sql, static::class, []);
        if (empty($res)) {
            return false;
        }
        return $res;
    }
}