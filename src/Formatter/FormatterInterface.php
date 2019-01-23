<?php
declare(strict_types=1);


namespace App\Formatter;


interface FormatterInterface {
    public function setData($data);
    public function convert();
}