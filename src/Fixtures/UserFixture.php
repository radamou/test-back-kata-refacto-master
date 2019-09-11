<?php

namespace App\Fixtures;

use App\Entity\User;
use Faker\Factory;

class UserFixture
{
    public static function create(): User
    {
        $faker = Factory::create();

        return (new User())
            ->setId($faker->randomNumber())
            ->setFirstName("Fixture User Name")
            ->setLastName($faker->lastName)
            ->setEmail($faker->email);
    }
}
