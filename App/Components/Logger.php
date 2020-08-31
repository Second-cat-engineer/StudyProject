<?php

namespace App\Components;

class Logger
{
    protected string $log;

    public function __construct($error)
    {
        $this->log = date('H.i.s, F j, Y') .
            " Сообщение:  {$error->getMessage()}  
            Ошибка возникла в файле -  {$error->getFile()} , 
            в строке -  {$error->getLine() }.";
    }

    public function saveLog()
    {
        $logs = file(__DIR__ . '/../../logs', FILE_IGNORE_NEW_LINES);
        $logs[] = $this->log;
        $file = implode("\n", $logs);

        file_put_contents(__DIR__ . '/../../logs', $file);
    }
}