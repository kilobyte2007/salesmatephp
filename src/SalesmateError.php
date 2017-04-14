<?php

namespace instantjay\salesmatephp;

class SalesmateError {
    private $code;
    private $name;
    private $message;

    public function __construct($code, $name, $message)
    {
        $this->code = $code;
        $this->name = $name;
        $this->message = $message;
    }

    public function getCode() {
        return $this->code;
    }

    public function getName() {
        return $this->name;
    }

    public function getMessage() {
        return $this->message;
    }
}