<?php

namespace Laraboost\Laraboost;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laraboost\Laraboost\Skeleton\SkeletonClass
 */
class LaraboostFacade extends Facade
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
