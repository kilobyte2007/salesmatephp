<?php

namespace instantjay\salesmatephp\entity;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use instantjay\salesmatephp\SalesmateConnection;
use instantjay\salesmatephp\SalesmateResponse;
use Respect\Validation\Validator;

abstract class SalesmateEntity {
    protected $path;

    /**
     * @var $data string[]
     */
    protected $data;

    /**
     * @var $availableProperties string[]
     */
    protected $availableProperties;

    /**
     * @var SalesmateConnection
     */
    private $connection;

    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * @return SalesmateResponse
     * @throws \Exception Thrown if object could not be mapped to anything saved on Salesmate
     */
    public function delete() {
        if(!Validator::numeric()->validate($this->data['id']))
            throw new \Exception('Unknown object; missing id.');

        $response = $this->commit($this->connection, 'DELETE');

        return $response;
    }

    protected function getData() {
        return $this->data;
    }

    protected function getPath() {
        $path = $this->path;

        if(!empty($this->data['id'])) {
            $id = $this->data['id'];

            $path .= "/$id";
        }

        return $path;
    }

    public function getId() {
        return $this->data['id'];
    }

    /**
     * @param null $propertyName
     * @return string|\string[]
     * @throws \Exception
     */
    protected function getProperty($propertyName) {
        if(!in_array($propertyName, $this->availableProperties))
            throw new \Exception('Property does not exist.');

        if(isset($this->data[$propertyName]))
            return $this->data[$propertyName];

        return null;
    }

    /**
     * @param $httpMethod string GET, PUT, DELETE etc
     * @param $salesmateConnection SalesmateConnection
     * @returns SalesmateResponse
     */
    public function commit($salesmateConnection, $httpMethod = null) {
        // Guess the HTTP method
        if($httpMethod == null) {
            if(!empty($this->data['id']))
                $httpMethod = 'PUT';
            else
                $httpMethod = 'POST';
        }

        $client = new Client();

        $payload = \GuzzleHttp\json_encode($this->getData(), JSON_NUMERIC_CHECK);

        $request = new Request($httpMethod, $salesmateConnection->getUrl().$this->getPath(), $salesmateConnection->getRequestHeaders(), $payload);
        $response = $client->send($request);

        $response = new SalesmateResponse($response);

        if($httpMethod == 'POST') { // We are submitting a new item. Let's update our object with the ID that we get back, so that we can use it right away.
            $data = $response->getData();
            $this->data['id'] = $data['id'];
        }

        return $response;
    }
}