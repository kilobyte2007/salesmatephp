<?php

namespace instantjay\salesmatephp\entity;

class Activity extends SalesmateEntity {
    public function __construct($url)
    {
        $this->path = '/activities';

        parent::__construct();
    }

    public function delete() {

    }
}