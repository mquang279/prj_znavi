<?php

namespace App\Exceptions;
use Exception;
class ConFlictState extends Exception
{
    public array $details;
    public function __construct(
        string $message = 'Conflict state',
        array $details = []
    ) {
        parent::__construct($message, 409);

        $this->details = $details;
    }

    public function getDetails(): array
    {
        return $this->details;
    }
}
