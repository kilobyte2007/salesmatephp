<?php

namespace instantjay\salesmatephp;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use instantjay\salesmatephp\exception\InvalidFormatException;
use Respect\Validation\Validator;

class SalesmateConnection {
    private $url;

    private $privateKey;
    private $sessionToken;
    private $accessKey;

    /**
     * SalesmateConnection constructor.
     * @param $url string Full URL to the Salesmate.io API, i.e. including /apis/v1. No trailing slash.
     * @param $privateKey
     * @param $sessionToken
     * @param $accessKey
     * @throws InvalidFormatException Thrown if any of the four required inputs appear to be invalid.
     */
    public function __construct($url, $privateKey, $sessionToken, $accessKey) {
        if(!Validator::url()->validate($url))
            throw new InvalidFormatException('Provided URL is not a valid URL.');

        if(!Validator::alnum('-')->validate($privateKey))
            throw new InvalidFormatException('Misshaped private key.');

        if(!Validator::alnum('-')->validate($sessionToken))
            throw new InvalidFormatException('Misshaped session token.');

        if(!Validator::alnum('-')->validate($accessKey))
            throw new InvalidFormatException('Misshaped access key.');

        $this->url = $url;
        $this->privateKey = $privateKey;
        $this->sessionToken = $sessionToken;
        $this->accessKey = $accessKey;
    }

    public function getUrl() {
        return  $this->url;
    }

    public function getPrivatekey() {
        return $this->privateKey;
    }

    public function getSessionToken() {
        return $this->sessionToken;
    }

    public function getAccessKey() {
        return $this->accessKey;
    }

    public function getHttpClient() {
        $client = new Client([
            'timeout' => 10,
            'headers' => $this->getRequestHeaders()
        ]);

        return $client;
    }

    public function getRequestHeaders() {
        //
        $headers = [
            'AppPrivateKey' => $this->getPrivatekey(),
            'SessionToken' => $this->getSessionToken(),
            'AppAccessKey' => $this->getAccessKey(),
            'Content-Type' => 'application/json'
        ];

        return $headers;
    }
}