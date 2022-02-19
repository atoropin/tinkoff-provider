<?php

namespace TinkoffProvider\Facades;

use Illuminate\Support\Facades\Facade;

class TinkoffFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tinkoff';
    }
}
