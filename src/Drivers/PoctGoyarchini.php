<?php


namespace Zek\Sms\Drivers;


use Zek\Sms\Exceptions\SmsException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PoctGoyarchini extends Driver
{
    /**
     * The api url
     *
     * @var string
     */

    protected $url;


    /**
     * The api user
     *
     * @var string
     */

    protected $user;

    /**
     * The api password
     *
     * @var string
     */

    protected $password;

    /**
     * PoctGoyarchini constructor.
     */
    public function __construct(){
        $this->url = config('sms.poct_goyarchini.url.'.$this->country) ?? config('sms.poct_goyarchini.url.others');
        $this->user = config('sms.poct_goyarchini.user');
        $this->password = config('sms.poct_goyarchini.password');
    }


    /**
     * Send message to the single recipient
     *
     * @return void
     * @throws GuzzleException
     * @throws SmsException
     */
    public function send()
    {
        $client = new Client();
        $res = $client->request('GET', $this->url, [
            "query" => [
                'user' => $this->user,
                'password' => $this->password,
                'gsm' => $this->recipient,
                'text' => $this->message
            ]
        ]);
        $body = explode('&', $res->getBody());
        $code = explode('=', $body[0]);
        if ($res->getStatusCode() !== 200 or $code[1] != 0){
            throw new SmsException('Provider returned error: '. $res->getBody());
        }
    }

    public function bulkSend()
    {
        // TODO: Implement bulkSend() method.
    }
}
