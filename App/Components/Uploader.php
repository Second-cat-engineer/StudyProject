<?php

namespace App\Components;

class Uploader
{
    protected $error;
    protected $extension;
    protected $nameImage;
    protected $size;
    protected $tmpName;
    protected $allowedExtension = ['png', 'jpg'];
    public string $pathImage;
    const ALLOWED_SIZE = 500000;

    public function __construct($data)
    {
        $this->error = $data['image']['error'];
        $this->nameImage = $data['image']['name'];
        $this->extension = pathinfo($data['image']['name'], PATHINFO_EXTENSION);
        $this->size = $data['image']['size'];
        $this->tmpName = $data['image']['tmp_name'];
    }

    protected function isUpload()
    {
        return (0 == $this->error);
    }

    protected function allowExtension()
    {
        return in_array($this->extension, $this->allowedExtension);
    }

    protected function allowSize()
    {
        return ($this->size < self::ALLOWED_SIZE);
    }

    public function upload()
    {
        if (!$this->isUpload()) {
            throw new \App\Exceptions\Uploader('Ошибка при загрузке изображения');
        }
        if (!$this->allowExtension()) {
            throw new \App\Exceptions\Uploader('Загрузка такого формата запрещена');
        }
        if (!$this->allowSize()) {
            throw new \App\Exceptions\Uploader('Размер изображения превышает допустимый');
        }

        $images = scandir(__DIR__ . '/../../src/images/');
        if (in_array($this->nameImage, $images)) {
            $this->pathImage = time() . '.' . $this->extension;
        } else {
            $this->pathImage = $this->nameImage;
        }

        $res =move_uploaded_file($this->tmpName, __DIR__ . '/../../src/images/' . $this->pathImage);
        if (!$res) {
            throw new \App\Exceptions\Uploader('Ошибка при сохранении изображения');
        }
    }
}