<?php
declare(strict_types=1);


namespace App\Formatter;


interface FromStringInterface {
    public function convertFromString($string);
}
