<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Quote;
use App\Entity\User;
use App\Fixtures\FixturesLoader;
use App\Repository\DestinationRepository;
use App\Repository\SiteRepository;

final class TextBuilder
{
    /**
     * @var FixturesLoader
     */
    private $fixtureLoader;

    /** @var string */
    private $text = '';

    public function __construct(FixturesLoader $fixtureLoader)
    {
        $this->fixtureLoader = $fixtureLoader;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function addUser(string $text, array $data): self
    {
        $user = (isset($data['user']) && ($data['user'] instanceof User)) ? $data['user'] : $this->fixtureLoader->load(User::class);

        if (false !== \strpos($text, '[user:first_name]')) {
            $text = \str_replace('[user:first_name]', \ucfirst(\mb_strtolower($user->getFirstName())), $text);
        }

        $this->text = $text;

        return $this;
    }

    public function addQuote(string $text, array $data): self
    {
        if (!isset($data['quote'])) {
            $this->text = $text;
        }

        if (!($quote = $data['quote']) instanceof Quote) {
            $this->text = $text;
        }

        $site = SiteRepository::getInstance()->getById($quote->getSiteId());
        $destination = DestinationRepository::getInstance()->getById($quote->getDestinationId());

        if (false !== \strpos($text, '[quote:summary_html]')) {
            $this->text = \str_replace('[quote:summary_html]', Quote::renderHtml($quote), $text);
        }

        if (false !== \strpos($text, '[quote:summary]')) {
            $this->text = \str_replace('[quote:summary]', Quote::renderText($quote), $text);
        }

        if (false !== \strpos($text, '[quote:destination_name]')) {
            $this->text = \str_replace('[quote:destination_name]', $destination->getCountryName(), $text);
        }

        if (false !== \strpos($text, '[quote:destination_link]')) {
            $this->text = \str_replace(
                '[quote:destination_link]',
                $site->getUrl().'/'.$destination->getCountryName().'/quote/'.$quote->getId(),
                $text
            );
        }

        return $this;
    }
}
