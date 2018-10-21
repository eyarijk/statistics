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
        $this->dir =  __DIR__.'/';
        $this->answerDir = 'answers';
    }

    public function showForm()
    {
        $html = include $this->dir .'form.html';
        echo $html;
    }

    public function saveForm()
    {
        $steps = $_POST['steps'] ?? 9;
        $answer = '';

        for ($i = 1;$i <= $steps;$i++) {
            $answer .= $i .' - '.($_POST["step$i"] ?? '' ). "\n";
        }

        $fileName = date('d-m-Y H:i:s').'.txt';
        $dir = $this->dir . $this->answerDir;
        $path = $dir .'/'.$fileName;

        if (!file_exists($dir)) {
            if (!mkdir($dir, 0777, true) && is_dir($dir)) {
                die('Не удалось создать директории... Создайте директорию в корне проекта под названием: '. $this->answerDir);
            }
        }

        $fp = fopen($path, 'w');

        fwrite($fp, $answer);
        fclose($fp);
    }
}