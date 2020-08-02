<?php

namespace Zek\Sms\Contracts;

interface SMS {
    /**
     * Send the message to the given recipient.
     * @return mixed
     */
    public function send();

    /**
     * Send the multiple messages to multiple recipient.
     * @return mixed
     */
    public function bulkSend();
}
