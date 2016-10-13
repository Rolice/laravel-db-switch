<?php
namespace Rolice\LaravelDbSwitch\Facades;

use Illuminate\Support\Facades\Facade;

class DbSwitch extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     */
    protected static function getFacadeAccessor()
    {
        return 'db.switch';
    }

}