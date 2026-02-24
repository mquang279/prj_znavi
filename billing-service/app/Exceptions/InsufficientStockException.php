<?php
namespace App\Exceptions;

use Exception;
use Throwable;

class InsufficientStockException extends Exception{
    public function __construct(string $message = "Not enough stock for some items", private array $details =[])
    {
        return parent::__construct($message);
    }

    public function getDetails():array{
        return $this->details;
    }
}