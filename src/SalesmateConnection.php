<?php

namespace instantjay\salesmatephp;

use instantjay\salesmatephp\exception\InvalidFormatException;
use Respect\Validation\Validator;

class SalesmateConnection {
    private $url;

    private $privateKey;
    private $sessionToken;
    private $accessKey;

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
        return  $this->url.'/'.$this->apiEndpoint;
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
}