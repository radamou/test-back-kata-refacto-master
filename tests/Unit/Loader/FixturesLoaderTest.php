<?php

namespace App\Tests\Loader;

use App\Entity\Destination;
use App\Entity\Template;
use App\Entity\User;
use App\Fixtures\FixturesLoader;
use PHPUnit\Framework\TestCase;

class FixturesLoaderTest extends  TestCase
{
    public function testLoad(): void
    {
        $fixturesLoader = FixturesLoader::getInstance();
        $this->assertInstanceOf(User::class, $fixturesLoader->load(User::class));
        $this->assertInstanceOf(Template::class, $fixturesLoader->load(Template::class));

        $this->expectException(\InvalidArgumentException::class);
        $fixturesLoader->load(Destination::class);
    }
}
