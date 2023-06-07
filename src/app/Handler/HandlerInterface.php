<?php
namespace App\Handler;

interface HandlerInterface
{
    /**
     * @param array $req
     * @return array
     */
    public function run(array $req): array;
}
