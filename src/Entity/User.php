<?php

namespace instantjay\salesmatephp\entity;

class User extends SalesmateEntity {
    public function __construct($url)
    {
        $this->path = '/users';

        parent::__construct($url);
    }

    public function delete() {

    }
}