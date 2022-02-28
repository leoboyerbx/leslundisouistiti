<?php

namespace App\DataFixtures\Providers;

use App\Entity\User;

class RandomStatusProvider
{
    public function __construct()
    {
    }

    public function randomStatus(): string
    {
        $statuses = ['pending', 'accepted', 'rejected'];
        return $statuses[array_rand($statuses)];
    }
}
