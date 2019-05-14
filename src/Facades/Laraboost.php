<?php

namespace Laraboost\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laraboost\Laraboost\Skeleton\SkeletonClass
 */
class Laraboost extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraboost';
    }
}
