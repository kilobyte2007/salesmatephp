<?php

namespace instantjay\salesmatephp\entity;

use instantjay\salesmatephp\exception\InvalidFormatException;
use instantjay\salesmatephp\MissingCompulsoryPropertyException;

class Deal extends SalesmateEntity {
    public function __construct($data = [])
    {
        $this->path = '/deals';

        parent::__construct($data);

        $this->availableProperties = [
            'id',
            'title',
            'primaryContact',
            'primaryCompany',
            'owner',
            'estimatedCloseDate',
            'dealValue',
            'currency',
            'pipeline',
            'stage',
            'source',
            'priority',
            'status',
            'description',
            'tags',
            'followers'
        ];
    }

    /**
     * @param \instantjay\salesmatephp\SalesmateConnection $salesmateConnection
     * @param string $httpMethod
     * @return \instantjay\salesmatephp\SalesmateResponse
     */
    public function commit($salesmateConnection, $httpMethod = null)
    {
        return parent::commit($salesmateConnection, $httpMethod);
    }

    /**
     * @param $title string
     */
    public function setTitle($title) {
        $this->data['title'] = $title;
    }

    /**
     * @param $ownerId int
     */
    public function setOwner($ownerId) {
        $this->data['owner'] = $ownerId;
    }

    /**
     * @param $primaryContactId int
     */
    public function setPrimaryContact($primaryContactId) {
        $this->data['primaryContact'] = $primaryContactId;
    }

    public function addFollowerUser($userId) {
        $this->data['followers'][]['userId'] = $userId;
    }

    public function addFollowerContact($contactId) {
        $this->data['followers'][]['contactId'] = $contactId;
    }

    public function getId() {
        return $this->data['id'];
    }

    public function getTitle() {
        return $this->data['title'];
    }

    public function getPrimaryContact() {
        return $this->data['primaryContact'];
    }

    public function getPrimaryCompany() {
        return $this->data['primaryCompany'];
    }

    public function getOwner() {
        return $this->data['owner'];
    }

    public function getEstimatedCloseDate() {
        return $this->data['estimatedCloseDate'];
    }

    public function setEstimatedCloseDate($closeDate) {
        $this->data['estimatedCloseDage'] = $closeDate;
    }

    public function getDealValue() {
        return $this->data['dealValue'];
    }

    public function getCurrency() {
        return $this->data['currency'];
    }

    public function getPipeline() {
        return $this->data['pipeline'];
    }

    public function setPipeline($pipeline) {
        $this->data['pipeline'] = $pipeline;
    }

    public function getStage() {
        return $this->data['stage'];
    }

    public function setStage($stage) {
        $this->data['stage'] = $stage;
    }

    public function getSource() {
        return $this->data['source'];
    }

    public function getPriority() {
        return $this->data['priority'];
    }

    public function getStatus() {
        return $this->data['status'];
    }

    /**
     * @param $status string Open, Won or Lost
     * @throws InvalidFormatException
     */
    public function setStatus($status) {
        if(!in_array($status, ['Open', 'Won', "Lost"]))
            throw new InvalidFormatException('Deal status must be Open, Won or Lost according to Salesmate API spec.');

        $this->data['status'] = $status;
    }

    public function getDescription() {
        return $this->data['description'];
    }

    public function getTags() {
        return $this->data['tags'];
    }
    
    public function getFollowers() {
        return $this->data['followers'];
    }
}