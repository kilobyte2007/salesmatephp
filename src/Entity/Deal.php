<?php

namespace instantjay\salesmatephp\entity;

class Deal extends SalesmateEntity {
    public function __construct($data)
    {
        $this->path = '/deals';

        parent::__construct($data);

        $this->properties = [
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
}