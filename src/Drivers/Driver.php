<?php


namespace Zek\Sms\Drivers;


use Zek\Sms\Exceptions\SmsException;
use Zek\Sms\Contracts\SMS;
use Throwable;

abstract class Driver implements SMS
{
    /**
     *The sms driver name
     *
     * @var string
     */
    protected $driverName;

    /**
     * The recipient of the message.
     *
     * @var string
     */
    protected $recipient;

    /**
     * The array of recipients.
     *
     * @var array
     */
    protected $recipientList;

    /**
     * The message to send.
     *
     * @var string
     */
    protected $message;

    /**
     * The list of messages.
     *
     * @var array
     */
    protected $messageList;

    /**
     * The country code
     *
     * @var integer
     */
    protected $country = 994;

    /**
     * {@inheritdoc}
     */
    abstract public function send();

    /**
     * {@inheritdoc}
     */
    abstract public function bulkSend();

    /**
     * Set the recipient of the message.
     *
     * @param string|array $recipient
     * @return Driver
     * @throws Throwable
     *
     */
    public function to(string $recipient)
    {
        if (!is_string($recipient) and !is_array($recipient))
            throw new SmsException('Recipient type must be array or string');
        if (is_string($recipient))
            $this->recipient = $recipient;
        if (is_array($recipient))
            $this->recipientList = $recipient;
        return $this;
    }

    /**
     * Set the content of the message.
     *
     * @param string|array $message
     * @return Driver
     * @throws Throwable
     */
    public function content(string $message)
    {
        if (!is_string($message) and !is_array($message))
            throw new SmsException('Content type must be array or string');
        if (is_string($message))
            $this->message = $message;
        if (is_array($message))
            $this->messageList = $message;
        return $this;
    }

    /**
     * Set the country code
     *
     * @param int $country
     * @return $this
     * @throws Throwable
     */
    public function country(int $country)
    {
        throw_if(empty($country), SmsException::class);
        $this->country = $country;
        return $this;
    }

    /**
     * Get the type of sms
     *
     * @return string
     * @throws SmsException
     */
    public function getSmsSendType(){
        if ($this->recipient and $this->message)
            return 'one-to-one';
        if ($this->messageList and $this->recipient)
            return 'one-to-many';
        if ($this->messageList and $this->recipientList)
            return 'many_to_many';
        throw new SmsException('Invalid sms format');
    }
}
