<?php

declare(strict_types=1);

namespace App\Entity;

class Destination
{
    /** @var int */
    private $id;
    /** @var string */
    private $countryName;
    /** @var string */
    private $conjunction;
    /** @var string */
    private $name;
    /** @var string */
    private $computerName;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getConjunction(): string
    {
        return $this->conjunction;
    }

    public function setConjunction(string $conjunction): self
    {
        $this->conjunction = $conjunction;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComputerName(): string
    {
        return $this->computerName;
    }

    public function setComputerName(string $computerName): self
    {
        $this->computerName = $computerName;

        return $this;
    }
}
