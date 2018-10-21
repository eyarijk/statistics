<?php

namespace App\Handle;

class Handle
{
    private $dir;

    public static function factory()
    {
        return new self();
    }

    public function __construct()
    {
        $this->dir =  __DIR__.'/';
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
        $path = $this->dir .'answers/'.$fileName;

        $fp = fopen($path, 'w');

        fwrite($fp, $answer);
        fclose($fp);
    }
}