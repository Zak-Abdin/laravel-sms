<?php


namespace Zek\Sms;


use Zek\Sms\Drivers\NullDriver;
use Zek\Sms\Drivers\PoctGoyarchini;
use Illuminate\Support\Manager;

class SmsManager extends Manager
{
    /**
     * Get instance of driver
     * @param string|null $name
     * @return mixed
     */
    public function channel($name = null){
        return $this->driver($name);
    }

    /**
     * Create a Null SMS driver instance.
     *
     * @return NullDriver
     */
    public function createNullDriver()
    {
        return new NullDriver;
    }

    /**
     * Create a PoctGoyarchini SMS driver instance.
     *
     * @return PoctGoyarchini
     */
    public function createPoctGoyarchiniDriver()
    {
        return new PoctGoyarchini();
    }

    public function getDefaultDriver()
    {
        return config('sms.default');
    }
}
