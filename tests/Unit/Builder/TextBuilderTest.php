<?php

namespace App\Tests\Builder;

use App\Builder\TextBuilder;
use App\Entity\User;
use App\Fixtures\FixturesLoader;
use PHPUnit\Framework\TestCase;

class TextBuilderTest extends TestCase
{
    /** @var FixturesLoader */
    private $fixtureLoader;
    /** @var TextBuilder */
    private $textBuilder;

    public function setUp(): void
    {
        $this->fixtureLoader = FixturesLoader::getInstance();
        $this->textBuilder = new TextBuilder($this->fixtureLoader);
    }

    public function tearDown(): void
    {
        $this->fixtureLoader = null;
        $this->textBuilder = null;

    }

    public function testAddUser(): void
    {
        $text = 'Bienvenu chez Evaneos [user:first_name]';
        $user =  $this->fixtureLoader->load(User::class);

        $this->assertEquals(
            'Bienvenu chez Evaneos Fixture user name',
            $this->textBuilder->addUser($text, ['user' => $user])->getText()
        );
    }
}
