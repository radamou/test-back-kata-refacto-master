<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Entity\Template;
use App\TemplateManager;
use App\Entity\Quote;
use App\Fixtures\FixturesLoader;

$fixtureLoader = FixturesLoader::getInstance();
$templateManager = new TemplateManager($fixtureLoader);

$message = $templateManager->getTemplateComputed(
    $fixtureLoader->load(Template::class),
    [
        'quote' => $fixtureLoader->load(Quote::class)
    ]
);

echo $message->getSubject() . "\n" . $message->getContent();
