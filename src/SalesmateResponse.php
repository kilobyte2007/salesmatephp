<?php

namespace instantjay\salesmatephp;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp;

class SalesmateResponse {
    /** @var Response */
    private $response;

    private $httpCode;
    private $status;
    private $error;
    private $data;

    /**
     * SalesmateResponse constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;

        $r = GuzzleHttp\json_decode($this->response->getBody(), true);

        $this->httpCode = $this->response->getStatusCode();
        $this->status = $r['Status'];

        if(!empty($r['Error'])) {
            $error = new SalesmateError($r['Error']['Code'], $r['Error']['Name'], $r['Error']['Message']);
            $this->error = $error;
        }

        if(!empty($r['Data'])) {
            $this->data = $r['Data'];
        }
    }

    public function getHttpCode() {
        return $this->httpCode;
    }

    public function isSuccessful() {
        if($this->status == 'success')
            return true;

        return false;
    }

    /**
     * @returns SalesmateError
     */
    public function getError() {
        return $this->error;
    }

    /**
     * @return string[]
     */
    public function getData() {
        return $this->data;
    }
}