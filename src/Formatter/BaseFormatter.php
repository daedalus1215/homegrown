<?php
declare(strict_types=1);


namespace App\Formatter;


abstract class BaseFormatter {

    protected $data;

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public abstract function convert(): string;

    public function __toString()
    {
        return $this->convert();
    }
}