<?php

namespace instantjay\salesmatephp\Entity;

class Company extends SalesmateEntity {
    public function __construct($data)
    {
        $this->path = '/companies';

        parent::__construct($data);
    }
}