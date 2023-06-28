<?php

declare(strict_types=1);

namespace App\Model;
class Logging
{
    /**
     * @param string $email
     */
    public function __construct(
        public string $email,
    )
    {
    }
}