<?php

namespace App\Tests\Builder;

use App\Builder\TemplateBuilder;
use App\Builder\TextBuilder;
use App\Entity\Quote;
use App\Entity\Template;
use App\Fixtures\FixturesLoader;
use App\Repository\DestinationRepository;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class TemplateBuilderTest extends TestCase
{
    private $faker;
    /** @var FixturesLoader */
    private $fixtureLoader;
    /** @var TextBuilder */
    private $textBuilder;

    /** Init the mocks */
    public function setUp(): void
    {
        $this->faker = Factory::create();
        $this->fixtureLoader = FixturesLoader::getInstance();
        $this->textBuilder = new TextBuilder($this->fixtureLoader);
    }

    /** Closes the mocks */
    public function tearDown(): void
    {
        $this->faker = null;
        $this->fixtureLoader = null;
        $this->textBuilder = null;
    }

    /**
     * @test
     */
    public function testBuildTemplate(): void
    {
        $expectedDestination = DestinationRepository::getInstance()->getById($this->faker->randomNumber());
        $templateBuilder= new TemplateBuilder($this->textBuilder);

        $message = $templateBuilder->buildTemplate(
            $this->fixtureLoader->load(Template::class),
            [
                'quote' => $this->fixtureLoader->load(Quote::class)
            ]
        );

        $this->assertEquals(
            'Votre voyage avec une agence locale ' . $expectedDestination->getCountryName(),
            $message->getSubject()
        );
        $this->assertEquals(
            "Bonjour Fixture user name, Merci d'avoir contacté un agent local pour votre voyage ".$expectedDestination->getCountryName().". Bien cordialement, L'équipe Evaneos.com www.evaneos.com",
            $message->getContent()
        );
    }
}
