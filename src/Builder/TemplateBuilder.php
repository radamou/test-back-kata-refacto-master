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

    public function buildTemplate($template, array $data): Template
    {
        if (!$template instanceof Template) {
            throw new \RuntimeException('no tpl given');
        }

        $template = $template
            ->withContent($this->computeText($template->getContent(), $data))
            ->withSubject($this->computeText($template->getSubject(), $data));

        return $template;
    }

    private function computeText($text, array $data): string
    {
        $text = \str_replace('[quote:destination_link]', '', $text);
        $user  = (isset($data['user'])  and ($data['user']  instanceof User))  ? $data['user']  : $this->fixtureLoader->load(User::class);

        if($user && false !== strpos($text, '[user:first_name]')) {
            $text = \str_replace('[user:first_name]', ucfirst(\mb_strtolower($user->getFirstName())), $text);
        }

        if(!isset($data['quote'])) {
            return $text;
        }

        if(!($quote = $data['quote']) instanceof Quote) {
            return $text;
        }

        $quoteFromRepository = QuoteRepository::getInstance()->getById($quote->getId());
        $useFulObject = SiteRepository::getInstance()->getById($quote->getSiteId());
        $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->getDestinationId());

        if(strpos($text, '[quote:destination_link]') !== false){
            $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());
        }

        $containsSummaryHtml = strpos($text, '[quote:summary_html]');
        $containsSummary     = strpos($text, '[quote:summary]');

        if ($containsSummaryHtml !== false || $containsSummary !== false) {
            if ($containsSummaryHtml !== false) {
                $text = str_replace(
                    '[quote:summary_html]',
                    Quote::renderHtml($quoteFromRepository),
                    $text
                );
            }
            if (false !== $containsSummary) {
                $text = str_replace(
                    '[quote:summary]',
                    Quote::renderText($quoteFromRepository),
                    $text
                );
            }
        }

        if (false !== strpos($text, '[quote:destination_name]')) {
            $text = str_replace('[quote:destination_name]', $destinationOfQuote->getCountryName(), $text);

        }

        if (isset($destination)) {
            $text = \str_replace(
                '[quote:destination_link]',
                $useFulObject->getUrl() . '/' . $destination->getCountryName() . '/quote/' . $quoteFromRepository->getId(),
                $text
            );
        }

        return $text;
    }
}
