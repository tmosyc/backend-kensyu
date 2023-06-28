<?php

namespace App\Service;

use App\Repository\LoggingRepo;

class LoggingService
{
    public static function logging($email)
    {
        return LoggingRepo::logging($email);
    }
}