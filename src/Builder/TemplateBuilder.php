<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Template;
use App\Helper\SingletonTrait;

class TemplateBuilder
{
    use SingletonTrait;

    /**
     * @var TextBuilder
     */
    private $textBuilder;

    public function __construct(TextBuilder $textBuilder)
    {
        $this->textBuilder = $textBuilder;
    }

    /**
     * @param mixed $template
     */
    public function buildTemplate($template, array $data): Template
    {
        if (!$template instanceof Template) {
            throw new \RuntimeException('no tpl given');
        }

        $template = $template
            ->withSubject($this->computeText($template->getSubject(), $data))
            ->withContent($this->computeText($template->getContent(), $data));

        return $template;
    }

    private function computeText(string $text, array $data): string
    {
        $this->textBuilder->addUser($text, $data)
                 ->addQuote($this->textBuilder->getText(), $data);

        return $this->textBuilder->getText();
    }
}
