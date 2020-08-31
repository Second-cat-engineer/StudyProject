<?php

namespace App\Components;

class Config
{
    use \App\Components\Singleton;

    public $data;

    protected function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }
}