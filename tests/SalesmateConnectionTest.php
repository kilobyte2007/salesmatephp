<?php

use instantjay\salesmatephp\SalesmateConnection;

class SalesmateConnectionTest extends \PHPUnit\Framework\TestCase {
    protected $salesmateConnection;

    protected function setUp() {
        $this->salesmateConnection = new SalesmateConnection('http://www.salesmate.io', '123', '123', '123');
    }

    public function testConstructor() {
        $this->assertNotEmpty($this->salesmateConnection);
    }
}