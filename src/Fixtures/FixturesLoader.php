<?php

namespace App\Fixtures;

use App\Entity\Quote;
use App\Entity\Site;
use App\Entity\Template;
use App\Entity\User;
use App\Helper\SingletonTrait;

class FixturesLoader
{
    use SingletonTrait;

    public function load(string $class)
    {
        switch ($class) {
            case User::class:
                return UserFixture::create();
                break;
            case Site::class:
                return SiteFixture::create();
                break;
            case Template::class:
                return TemplateFixture::create();
                break;
            case Quote::class:
                return QuoteFixture::create();
                break;
            default:
                return null;
        }
    }
}
