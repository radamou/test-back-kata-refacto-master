<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Quote;
use Faker\Factory;

class QuoteFixture
{
    public static function create(): Quote
    {
        $faker = Factory::create();

        return (new Quote())
            ->setId($faker->randomNumber())
            ->setDateQuoted(new \DateTimeImmutable())
            ->setDestinationId($faker->randomNumber())
            ->setSiteId($faker->randomNumber());
    }
}
