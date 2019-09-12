<?php

declare(strict_types=1);

namespace App\Entity;

class Template
{
    /** @var int */
    private $id;
    /** @var string */
    private $subject;
    /** @var string */
    private $content;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function withSubject(string $subject): self
    {
        $copy = clone $this;
        $copy->subject = $subject;

        return $copy;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function withContent(string $content): self
    {
        $copy = clone $this;
        $copy->content = $content;

        return $copy;
    }
}
