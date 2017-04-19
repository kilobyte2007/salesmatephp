<?php

namespace instantjay\salesmatephp\Entity;

class User extends SalesmateEntity {
    public function __construct($data)
    {
        $this->path = '/users';

        $this->availableProperties = [
            'id',
            'firstName',
            'lastName',
            'email',
            'allowedLoginFrom',
            'timezone',
            'photo',
            'dateFormat',
            'timeFormat',
            'emailSignature',
            'isActive',
            'invitationAccepted',
            'nickname',
            'Role',
            'Profile',
            'UserAccessTokens'
        ];

        parent::__construct($data);
    }

    public function getId() {
        return $this->data['id'];
    }

    public function getFirstName() {
        return $this->data['firstName'];
    }

    public function getLastName() {
        return $this->data['lastName'];
    }

    public function getEmail() {
        return $this->data['email'];
    }

    public function getAllowedLoginFrom() {
        return $this->data['allowedLoginFrom'];
    }

    public function getTimezone() {
        return $this->data['timezone'];
    }

    public function getPhoto() {
        return $this->data['photo'];
    }

    public function getDateFormat() {
        return $this->data['dateFormat'];
    }

    public function getTimeFormat() {
        return $this->data['timeFormat'];
    }

    public function getEmailSignature() {
        return $this->data['emailSignature'];
    }

    public function isActive() {
        return $this->data['isActive'];
    }

    public function getInvitationAccepted() {
        return $this->data['invitationAccepted'];
    }

    public function getNickname() {
        return $this->data['nickname'];
    }

    public function getRole() {
        return $this->data['Role'];
    }

    public function getProfile() {
        return $this->data['Profile'];
    }

    public function getUserAccessTokens() {
        return $this->data['UserAccessTokens'];
    }
}