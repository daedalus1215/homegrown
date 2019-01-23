<?php
declare(strict_types=1);


namespace App\Formatter;


class JSON extends BaseFormatter implements FormatterInterface, FromStringInterface, NamedFormatterInterface
{
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function convert(): string
    {
        return json_encode($this->data);
    }

    public function convertFromString($string)
    {
        return json_decode($string, true);
    }

    public function getName(): string
    {
        return 'JSON';
    }
}