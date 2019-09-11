<?php

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
            ->setDateQuoted(new \DateTime())
            ->setDestinationId($faker->randomNumber())
            ->setSiteId( $faker->randomNumber());
    }
}
