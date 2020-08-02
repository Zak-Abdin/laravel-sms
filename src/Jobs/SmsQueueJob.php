<?php

namespace Zek\Sms\Jobs;

use Zek\Sms\Drivers\Driver;
use Zek\Sms\Exceptions\SmsException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SmsQueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $queue;

    /**
     * Sms driver instance
     * @var Driver
     */
    private $smsDriver;

    /**
     * SmsQueueJob constructor.
     * @param Driver $smsDriver
     */
    public function __construct(Driver $smsDriver)
    {
        $this->smsDriver = $smsDriver;
        $this->queue = config('sms.queue_name');
    }

    /**
     * @throws SmsException
     */
    public function handle()
    {
        $smsType = $this->smsDriver->getSmsSendType();
        if ($smsType == 'one-to-one')
            $this->smsDriver->send();
        if ($smsType == 'one-to-many' or $smsType == 'many-to-many')
            $this->smsDriver->bulkSend();
    }
}
