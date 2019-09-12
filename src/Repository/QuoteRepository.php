<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Quote;
use App\Helper\SingletonTrait;
use Faker\Factory;

class QuoteRepository implements Repository
{
    use SingletonTrait;

    /** @var int */
    private $siteId;
    /** @var int */
    private $destinationId;
    /** @var \DateTime */
    private $date;

    /**
     * QuoteRepository constructor.
     */
    public function __construct()
    {
        // DO NOT MODIFY THIS METHOD
        $generator = Factory::create();

        $this->siteId = $generator->numberBetween(1, 10);
        $this->destinationId = $generator->numberBetween(1, 200);
        $this->date = new \DateTimeImmutable();
    }

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD, (I just used fluent pattern instead)
        return (new Quote())
            ->setId($id)
            ->setDateQuoted($this->date)
            ->setDestinationId($this->destinationId)
            ->setSiteId($this->siteId);
    }
}
