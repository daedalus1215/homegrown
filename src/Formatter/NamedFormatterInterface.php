<?php
declare(strict_types=1);


namespace App\Formatter;


interface NamedFormatterInterface {
    public function getName(): string;
}