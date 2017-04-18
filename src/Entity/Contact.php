<?php

namespace instantjay\salesmatephp\entity;

class Contact extends SalesmateEntity {
    public function __construct($data = [])
    {
        $this->availableProperties = [
            'id',
            'name',
            'owner',
            'email',
            'company',
            'phone',
            'otherPhone',
            'mobile',
            'description',
            'skypeId',
            'website'
        ];

        $this->path = '/contacts';

        parent::__construct($data);
    }

    public function setName($name) {
        $this->data['name'] = $name;
    }

    public function getName() {
        return $this->data['name'];
    }

    public function getOwner() {
        return $this->data['owner'];
    }

    public function setOwner($ownerId) {
        $this->data['owner'] = $ownerId;
    }

    public function setEmail($emailAddress) {
        $this->data['email'] = $emailAddress;
    }

    public function getEmail() {
        return $this->data['email'];
    }

    public function getCompany() {
        return $this->data['company'];
    }

    public function setCompany($companyId) {
        $this->data['company'] = $companyId;
    }

    public function getPhone() {
        return $this->data['phone'];
    }

    public function setPhone($phoneNumber) {
        $this->data['phone'] = $phoneNumber;
    }

    public function getOtherPhone() {
        return $this->data['otherPhone'];
    }

    public function setOtherPhone($phoneNumber) {
        $this->data['otherPhone'] = $phoneNumber;
    }

    public function getMobile() {
        return $this->data['mobile'];
    }

    public function setMobile($phoneNumber) {
        $this->data['mobile'] = $phoneNumber;
    }

    public function getDescription() {
        return $this->data['mobile'];
    }

    public function setDescription($description) {
        $this->data['description'] = $description;
    }

    public function getSkypeId() {
        return $this->data['skypeId'];
    }

    public function setSkypeId($skypeId) {
        $this->data['skypeId'] = $skypeId;
    }

    public function getWebsite() {
        return $this->data['website'];
    }

    public function setWebsite($website) {
        $this->data['website'] = $website;
    }
}