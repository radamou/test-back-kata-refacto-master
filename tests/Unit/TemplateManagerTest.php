<?php

namespace App\Tests;

use App\Context\ApplicationContext;
use App\Entity\Quote;
use App\Entity\Template;
use App\Repository\DestinationRepository;
use App\TemplateManager;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class TemplateManagerTest extends TestCase
{
    private $faker;

    /** Init the mocks */
    public function setUp()
    {
        $this->faker = Factory::create();
    }

    /** Closes the mocks */
    public function tearDown()
    {
        $this->faker = null;
    }

    /**
     * @test
     */
    public function test()
    {
        $expectedDestination = DestinationRepository::getInstance()->getById($this->faker->randomNumber());
        $expectedUser = ApplicationContext::getInstance()->getCurrentUser();

        $quote = new Quote(
            $this->faker->randomNumber(),
            $this->faker->randomNumber(),
            $this->faker->randomNumber(),
            $this->faker->date()
        );

        $template = new Template(
            1,
            'Votre voyage avec une agence locale [quote:destination_name]',
            "
Bonjour [user:first_name],

Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name].

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
");
        $templateManager = new TemplateManager();

        $message = $templateManager->getTemplateComputed(
            $template,
            [
                'quote' => $quote
            ]
        );

        $this->assertEquals('Votre voyage avec une agence locale ' . $expectedDestination->countryName, $message->subject);
        $this->assertEquals("
Bonjour " . $expectedUser->firstname . ",

Merci d'avoir contacté un agent local pour votre voyage " . $expectedDestination->countryName . ".

Bien cordialement,

L'équipe Evaneos.com
www.evaneos.com
", $message->content);
    }
}
