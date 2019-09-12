<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Template;

class TemplateFixture
{
    public static function create(): Template
    {
        return (new Template())
            ->setId(1)
            ->setSubject('Votre voyage avec une agence locale [quote:destination_name]')
            ->setContent("Bonjour [user:first_name], Merci d'avoir contacté un agent local pour votre voyage [quote:destination_name]. Bien cordialement, L'équipe Evaneos.com www.evaneos.com");
    }
}
