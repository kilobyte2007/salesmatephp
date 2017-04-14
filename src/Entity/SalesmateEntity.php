<?php

namespace instantjay\salesmatephp\entity;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use instantjay\salesmatephp\SalesmateConnection;
use instantjay\salesmatephp\SalesmateResponse;
use Respect\Validation\Validator;

abstract class SalesmateEntity {
    protected $path;
    protected $id;

    /**
     * @var $data string[]
     */
    protected $data;

    /**
     * @var $properties string[]
     */
    protected $properties;

    /**
     * @var SalesmateConnection
     */
    private $connection;

    public function __construct($data) {
        $this->data;

        if(!empty($this->data['id']))
            $this->id = $this->data['id'];
    }

    /**
     * @return SalesmateResponse
     * @throws \Exception Thrown if object could not be mapped to anything saved on Salesmate
     */
    public function delete() {
        if(!Validator::numeric()->validate($this->id))
            throw new \Exception('Unknown object; missing id.');

        $response = $this->commit('DELETE', $this->connection);

        return $response;
    }

    protected function getData() {
        return $this->data;
    }

    /**
     * @param null $propertyName
     * @return string|\string[]
     * @throws \Exception
     */
    protected function getProperty($propertyName) {
        if(!in_array($propertyName, $this->properties))
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
    public function commit($httpMethod, $salesmateConnection) {
        $headers = [
            'AppPrivateKey' => $salesmateConnection->getPrivatekey(),
            'SessionToken' => $salesmateConnection->getSessionToken(),
            'AppAccesskey' => $salesmateConnection->getAccessKey(),
            'Content-Type' => 'application/json'
        ];

        $client = new Client();
        $request = new Request($httpMethod, $salesmateConnection->getUrl().$this->path, $headers, \GuzzleHttp\json_encode($this->getData(), JSON_NUMERIC_CHECK));
        $response = $client->send($request);

        $response = new SalesmateResponse($response);

        return $response;
    }

    public function __get($propertyName) {
        $this->getProperty($propertyName);
    }

    public function __set($propertyName, $value) {
        $this->getProperty($propertyName);

        $this->data[$propertyName] = $value;
    }
}