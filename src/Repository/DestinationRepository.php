<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Destination;
use App\Helper\SingletonTrait;
use Faker\Factory;

class DestinationRepository implements Repository
{
    use SingletonTrait;

    /** @var string */
    private $country;
    /** @var string */
    private $conjunction;
    /** @var string */
    private $computerName;

    /**
     * DestinationRepository constructor.
     */
    public function __construct()
    {
        $this->country = Factory::create()->country;
        $this->conjunction = 'en';
        $this->computerName = Factory::create()->slug();
    }

    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD, same here
        return (new Destination())
            ->setId($id)
            ->setCountryName($this->country)
            ->setConjunction($this->conjunction)
            ->setComputerName($this->computerName);
    }
}
