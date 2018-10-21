<?php

namespace App\Handle;

class Handle
{
    private $dir;
    private $answerDir;

    public static function factory()
    {
        return new self();
    }

    public function __construct()
    {
        $this->dir =  __DIR__.DIRECTORY_SEPARATOR;
        $this->answerDir = 'answers';
    }

    public function showForm()
    {
        include $this->dir .'form.html';
    }

    public function saveForm()
    {
        $steps = $_POST['steps'] ?? 9;
        $answer = '';

        for ($i = 1;$i <= $steps;$i++) {
            $answer .= $i .' - '.$this->getAnswer($i). PHP_EOL;
        }

        $fileName = date('d-m-Y H-i-s').'.txt';
        $dir = $this->dir . $this->answerDir;
        $path = $dir .DIRECTORY_SEPARATOR .$fileName;

        if (!file_exists($dir)) {
            if (!mkdir($dir, 0777, true) && is_dir($dir)) {
                die('Не удалось создать директории... Создайте директорию в корне проекта под названием: '. $this->answerDir);
            }
        }

        file_put_contents($path,$answer);
    }

    private function getAnswer($step)
    {
        if (\is_array($_POST["step$step"])) {
            return implode(', ',$_POST["step$step"]);
        }
        return $_POST["step$step"] ?? '';
    }
}