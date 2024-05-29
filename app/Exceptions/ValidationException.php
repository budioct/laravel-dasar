<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{

    /**
     * registerkan di file ../app/Exceptions/Handler.php
     * di property:
     *
     * protected $dontReport = [
     *   ValidationException::class,
     * ];
     */

    public function __construct(string $message)
    {
        parent::__construct($message); // akses Exception super type construct dari parent
    }

}
