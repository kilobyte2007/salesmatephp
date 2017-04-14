<?php

namespace instantjay\salesmatephp\entity;

class Company extends SalesmateEntity {
    public function __construct($url)
    {
        $this->path = '/companies';

        parent::__construct();
    }

    protected function getBody() {

    }
}