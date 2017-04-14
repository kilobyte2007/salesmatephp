<?php

namespace instantjay\salesmatephp\entity;

class Contact extends SalesmateEntity {
    public function __construct($url)
    {
        $this->path = '/contacts';

        parent::__construct($url);
    }

    public function delete() {

    }
}