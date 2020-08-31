<?php

namespace App\Components;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View implements \Countable, \Iterator
{
    use \App\Components\Magical;

    protected $data = [];
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../');
        $this->twig = new Environment($loader);
    }

    public function twigDisplay($template, $param)
    {
        echo $this->twigRender($template, $param);
    }

    public function twigRender($template, $param)
    {
        return $this->twig->render($template, $param);

    }

    public function render($template)
    {
       ob_start();
       include $template;
       $content = ob_get_contents();
       ob_end_clean();
       return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function count()
    {
        return count($this->data);
    }

    // Метод должен вернуть значение текущего элемента
    public function current()
    {
        return current($this->data);
    }

    // Метод должен сдвинуть "указатель" на следующий элемент
    public function next()
    {
        next($this->data);
    }

    // Метод должен вернуть ключ текущего элемента
    public function key()
    {
        return key($this->data);
    }

    // Метод должен проверять - не вышел ли указатель за границы?
    public function valid()
    {
        return null !== key($this->data);
    }

    // Метод должен поставить "указатель" на первый элемент
    public function rewind()
    {
        reset($this->data);
    }
}