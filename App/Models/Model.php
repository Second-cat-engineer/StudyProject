<?php

namespace App\Models;

use App\Components\Db;
use App\Exceptions\MultiException;

abstract class Model
{
    protected const TABLE = '';

    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public static function findAll(): array
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, static::class);
    }

    public static function findById($id)
    {
        $param[':id'] = $id;
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $res = $db->query($sql, static::class, $param);
        if (empty($res)) {
            return false;
        }
        return $res[0];
    }

    public static function findLastCount($count)
    {
        if (is_numeric($count)) {
            $db = Db::instance();
            $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $count;
            return $db->query($sql, static::class);
        }
        return false;
    }

    public function insert(): bool
    {
        $props = get_object_vars($this);

        $columns = [];
        $binds = [];
        $data = [];
        foreach ($props as $name => $value) {
            if ('id' == $name) {
                continue;
            }

            $columns[] = $name;
            $binds[] = ':' . $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . ' 
        (' . implode(', ', $columns) . ') 
        VALUES (' . implode(', ', $binds) . ' )';
        var_dump($sql);

        $db = Db::instance();
        $res = $db->execute($sql, $data);
        $this->id = $db->lastId();
        return $res;
    }

    public function update(): bool
    {
        $props = get_object_vars($this);

        $columns = [];
        $data = [];

        foreach ($props as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $columns[] = $name . '=:' . $name;
            $data[':' . $name] = $value;
        }
        $data[':id'] = $this->id;

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $columns) . ' WHERE id=:id';

        $db = Db::instance();
        return $db->execute($sql, $data);
    }

    public function save(): bool
    {
        if (null === $this->id) {
            return $this->insert();
        }
        return $this->update();
    }

    public function delete(): bool
    {
        $data[':id'] = $this->id;
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';

        $db = Db::instance();
        return $db->execute($sql, $data);
    }


    public function fill(array $data)
    {
        $errors = new MultiException();

        foreach ($data as $prop => $value) {
            if ('id' == $prop) {
                continue;
            }
            try {
                $this->validator($prop, $value);
            } catch (\App\Exceptions\Validation $e) {
                $errors->add($e);
            }
        }

        if (!$errors->isEmpty()) {
            throw $errors;
        }
    }

    public static function findAllEach()
    {
        $db = Db::instance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->queryEach($sql, static::class);
    }
}