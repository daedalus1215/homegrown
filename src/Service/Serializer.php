<?php

namespace App\Service;


use App\Formatter\FormatterInterface;


class Serializer {
    private $format;

    public function __construct(FormatterInterface $format)
    {
        $this->format = $format;
    }

    public function serialize($data): string {
        $this->format->setData($data);
        return $this->format->convert();
    }
}