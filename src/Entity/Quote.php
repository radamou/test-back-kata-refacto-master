<?php

declare(strict_types=1);

namespace App\Entity;

class Quote
{
    /** @var int */
    private $id;
    /** @var int */
    private $siteId;
    /** @var int */
    private $destinationId;
    /** @var \DateTime */
    private $dateQuoted;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSiteId(): int
    {
        return $this->siteId;
    }

    public function setSiteId(int $siteId): self
    {
        $this->siteId = $siteId;

        return $this;
    }

    public function getDestinationId(): int
    {
        return $this->destinationId;
    }

    public function setDestinationId(int $destinationId): self
    {
        $this->destinationId = $destinationId;

        return $this;
    }

    public function getDateQuoted(): \DateTimeImmutable
    {
        return $this->dateQuoted;
    }

    public function setDateQuoted(\DateTimeImmutable $dateQuoted): self
    {
        $this->dateQuoted = $dateQuoted;

        return $this;
    }

    public static function renderHtml(self $quote): string
    {
        return '<p>'.$quote->id.'</p>';
    }

    public static function renderText(self $quote): string
    {
        return (string) $quote->id;
    }
}
