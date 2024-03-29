<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Site;
use App\Helper\SingletonTrait;
use Faker\Factory;

class SiteRepository implements Repository
{
    use SingletonTrait;

    /** @var string */
    private $url;

    public function __construct()
    {
        // DO NOT MODIFY THIS METHOD
        $this->url = Factory::create()->url;
    }

    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id)
    {
        // DO NOT MODIFY THIS METHOD, same here
        return (new Site())
            ->setId($id)
            ->setUrl($this->url);
    }
}
