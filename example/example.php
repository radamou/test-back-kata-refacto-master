<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Entity\Template;
use App\Entity\Quote;
use App\Fixtures\FixturesLoader;
use App\Builder\TemplateBuilder;
use App\Builder\TextBuilder;

$fixtureLoader = FixturesLoader::getInstance();
$textBuilder = new TextBuilder($fixtureLoader);
$templateBuilder = new TemplateBuilder($textBuilder);

$message = $templateBuilder->buildTemplate(
    $fixtureLoader->load(Template::class),
    [
        'quote' => $fixtureLoader->load(Quote::class)
    ]
);

echo $message->getSubject() . "\n" . $message->getContent();
