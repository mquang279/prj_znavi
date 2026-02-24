<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Exceptions;
use Exception;
class InventoryException extends Exception {
    public $code;
    public array $details;
    public function __construct(string $code, string $message, array $details=[])
    {
        parent::__construct($message);
        $this->code = $code;
        $this->details = $details;
    }
}
