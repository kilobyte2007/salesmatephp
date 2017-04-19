<?php

namespace instantjay\salesmatephp\Entity;

class Activity extends SalesmateEntity {
    public function __construct($data)
    {
        $this->path = '/activities';

        parent::__construct($data);
    }
}