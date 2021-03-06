<?php

namespace App\Models;

use App\Components\Db;

/**
 * class User
 * @property $id
 * @property $login
 * @property $password_hash
 * @property $access
 */
class User extends Model
{
    protected const TABLE = 'users';
    public string $login;
    public string $access;
    public string $password_hash;

    public static function findByLogin($login)
    {
        $parameters[':login'] = $login;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE login=:login';
        $res = $db->query($sql, static::class, $parameters);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }

    public function updateAccess()
    {
        $data[':id'] = $this->id;
        $data[':access'] = $this->access;

        $sql = 'UPDATE ' . static::TABLE . ' SET access=:access WHERE id=:id';

        $db = Db::instance();
        return $db->execute($sql, $data);
    }
}