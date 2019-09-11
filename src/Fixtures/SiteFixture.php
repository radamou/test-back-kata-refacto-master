<?php

namespace App\Fixtures;

use App\Entity\Site;
use Faker\Factory;

class SiteFixture
{
    public static function create(): Site
    {
        $faker = Factory::create();

        return (new Site())
            ->setId($faker->randomNumber())
            ->setUrl($faker->url);
    }
}
