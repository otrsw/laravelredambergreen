<?php

namespace Ontherocksoftware\LaravelRedAmberGreen\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelRedAmberGreen extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravelredambergreen';
    }
}
