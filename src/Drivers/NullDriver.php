<?php


namespace Zek\Sms\Drivers;


use Illuminate\Support\Facades\Log;

class NullDriver extends Driver
{

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        Log::info('message send!', [
            'country' => $this->country,
            'recipient' => $this->recipient,
            'content' => $this->message
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function bulkSend()
    {
        // TODO: Implement bulkSend() method.
    }
}
