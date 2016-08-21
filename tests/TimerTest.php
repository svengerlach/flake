<?php

namespace Svengerlach\Flake\Tests;

use Svengerlach\Flake\Timer;

class TimerTest extends \PHPUnit_Framework_TestCase
{

    private function getTimer() {
        return new Timer();
    }
    
    public function testReturnsAPositiveInteger() {
        $this->assertInternalType('integer', $this->getTimer()->getMilliseconds());
        $this->assertGreaterThan(0, $this->getTimer()->getMilliseconds());
    }
    
}