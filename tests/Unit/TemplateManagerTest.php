<?php

namespace App\Tests;

use App\Context\ApplicationContext;
use App\Entity\Quote;
use App\Entity\Template;
use App\Entity\User;
use App\Fixtures\FixturesLoader;
use App\Repository\DestinationRepository;
use App\TemplateManager;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class TemplateManagerTest extends TestCase
{
    private $faker;
    private $fixtureLoader;

    /** Init the mocks */
    public function setUp()
    {
        $this->faker = Factory::create();
        $this->fixtureLoader = FixturesLoader::getInstance();
    }

    /** Closes the mocks */
    public function tearDown()
    {
        $this->faker = null;
        $this->fixtureLoader = null;
    }

    /**
     * @test
     */
    public function test()
    {
        $expectedDestination = DestinationRepository::getInstance()->getById($this->faker->randomNumber());
        $templateManager = new TemplateManager($this->fixtureLoader);
        $expectedUser = $this->fixtureLoader->load(User::class);

        $message = $templateManager->getTemplateComputed(
            $this->fixtureLoader->load(Template::class),
            [
                'quote' => $this->fixtureLoader->load(Quote::class)
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale ' . $expectedDestination->getCountryName(), $message->getContent());
        $this->assertEquals(
            "Bonjour Fixture user name, Merci d'avoir contacté un agent local pour votre voyage ".$expectedDestination->getCountryName().". Bien cordialement, L'équipe Evaneos.com www.evaneos.com",
            $message->getSubject()
        );
    }
}
