<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Quote;
use App\Entity\Template;
use App\Entity\User;
use App\Fixtures\FixturesLoader;
use App\Repository\DestinationRepository;
use App\Repository\QuoteRepository;
use App\Repository\SiteRepository;

class TemplateBuilder
{
    /**
     * @var FixturesLoader
     */
    public $fixtureLoader;

    public function __construct(FixturesLoader $fixtureLoader)
    {
        $this->fixtureLoader = $fixtureLoader;
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
        $user = (isset($data['user']) && ($data['user']  instanceof User)) ? $data['user'] : $this->fixtureLoader->load(User::class);

        if ($user && false !== \strpos($text, '[user:first_name]')) {
            $text = \str_replace('[user:first_name]', \ucfirst(\mb_strtolower($user->getFirstName())), $text);
        }

        if (!isset($data['quote'])) {
            return $text;
        }

        if (!($quote = $data['quote']) instanceof Quote) {
            return $text;
        }

        $quote = QuoteRepository::getInstance()->getById($quote->getId());
        $site = SiteRepository::getInstance()->getById($quote->getSiteId());
        $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());

        if (false !== \strpos($text, '[quote:summary_html]')) {
            $text = \str_replace('[quote:summary_html]', Quote::renderHtml($quote), $text);
        }

        if (false !== \strpos($text, '[quote:summary]')) {
            $text = \str_replace('[quote:summary]', Quote::renderText($quote), $text);
        }

        if (!$destination) {
            return $text;
        }

        if (false !== \strpos($text, '[quote:destination_name]')) {
            $text = \str_replace('[quote:destination_name]', $destination->getCountryName(), $text);
        }

        if (false !== \strpos($text, '[quote:destination_link]')) {
            $text = \str_replace(
                '[quote:destination_link]',
                $site->getUrl().'/'.$destination->getCountryName().'/quote/'.$quote->getId(),
                $text
            );
        }

        return $text;
    }
}
