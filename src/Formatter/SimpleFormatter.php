<?php
declare(strict_types=1);


namespace App\Formatter;


class SimpleFormatter implements FormatterInterface{

    public function setData($data) {}
    public function convert() { return 'string';}


    public function _constructor()
    {
        echo "SimpleFormatter";
    }

    public function methodsName()
    {
        echo "calledMethod name";
    }
}