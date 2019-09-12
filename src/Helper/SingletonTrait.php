<?php

declare(strict_types=1);

namespace App\Helper;

trait SingletonTrait
{
    protected static $instance = null;

    /**
     * @return $this
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
