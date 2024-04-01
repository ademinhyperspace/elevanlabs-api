<?php

namespace Shahinyanm\ElevenlabsApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Shahinyanm\ElevenlabsApi\Skeleton\SkeletonClass
 */
class ElevenlabsApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'elevenlabs-api';
    }
}
