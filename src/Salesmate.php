<?php

namespace instantjay\salesmatephp;

use GuzzleHttp\Psr7\Request;
use instantjay\salesmatephp\entity\Deal;
use instantjay\salesmatephp\entity\User;

class Salesmate {
    const PIPELINE_EDITABLE_FIELD_ID = 69;

    private $connection;

    /**
     * Salesmate constructor.
     * @param $salesmateConnection SalesmateConnection
     */
    public function __construct($salesmateConnection) {
        $this->connection = $salesmateConnection;
    }

    /**
     * @return User[]
     * @throws EmptyResultException
     */
    public function getActiveUsers() {
        $client = $this->connection->getHttpClient();

        $request = new Request('GET', $this->connection->getUrl()."/users/active");

        $response = $client->send($request);

        $salesmateResponse = new SalesmateResponse($response);

        if(!$salesmateResponse->isSuccessful())
            throw new EmptyResultException('No users found.');

        $users = [];

        foreach($salesmateResponse->getData() as $i => $data) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function getDeal($dealId) {
        $client = $this->connection->getHttpClient();

        $request = new Request('GET', $this->connection->getUrl().'/deals/'.$dealId);

        $response = $client->send($request);

        $salesmateResponse = new SalesmateResponse($response);

        if(!$salesmateResponse->isSuccessful())
            throw new EmptyResultException();

        return new Deal($salesmateResponse->getData());
    }

    private function getEditableFields() {
        $client = $this->connection->getHttpClient();

        $request = new Request('GET', $this->connection->getUrl().'/deals/getEditableFields');

        $response = $client->send($request);

        $salesmateResponse = new SalesmateResponse($response);

        if(!$salesmateResponse->isSuccessful())
            throw new EmptyResultException();

        return $salesmateResponse->getData();
    }

    private function getEditableFieldById($editableFieldId) {
        $editableFields = $this->getEditableFields();

        foreach($editableFields as $editableField) {
            if($editableField['id'] == $editableFieldId) {
                return $editableField;
            }
        }

        return null;
    }

    public function getPipelineNames() {
        $editableField = $this->getEditableFieldById(self::PIPELINE_EDITABLE_FIELD_ID);
        $fieldOptions = json_decode($editableField['fieldOptions'], true);

        $pipelines = [];

        foreach($fieldOptions['values'] as $value) {
            $pipelines[] = $value;
        }

        return $pipelines;
    }

    public function getStageNames($pipelineName) {
        $editableField = $this->getEditableFieldById(self::PIPELINE_EDITABLE_FIELD_ID);
        $fieldOptions = json_decode($editableField['fieldOptions'], true);

        $stages = [];

        foreach($fieldOptions['mappedDependency'][0]['rules'][$pipelineName] as $value) {
            $stages[] = $value;
        }

        return $stages;
    }
}