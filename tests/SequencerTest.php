<?php

namespace Svengerlach\Flake\Tests;

use Svengerlach\Flake\Sequencer;

class SequencerTest extends \PHPUnit_Framework_TestCase
{

    private function getSequencer() {
        return new Sequencer();
    }
    
    public function testReturnsAnInteger() {
        $this->assertInternalType('integer', $this->getSequencer()->getNext(0));
    }
    
    public function testOverflowExceptionIfMaximumNumberOfSecondsInOneMillisecondIsReached() {
        $this->setExpectedException(\OverflowException::class);
        
        $sequencer = $this->getSequencer();
        
        for ( $i = 0; $i < 4096; $i++ ) {
            $sequencer->getNext(0);
        }
    }
    
    public function testSequenceForSameMillisecondIsRaisedByOne() {
        $sequencer = $this->getSequencer();
        
        $this->assertEquals(1, $sequencer->getNext(0));
        $this->assertEquals(2, $sequencer->getNext(0));
        $this->assertEquals(3, $sequencer->getNext(0));
    }
    
    public function testThatSequenceIsResetWhenMillisecondIsRaised() {
        $sequencer = $this->getSequencer();
        
        $this->assertEquals(1, $sequencer->getNext(0));
        $this->assertEquals(1, $sequencer->getNext(1));
    }
    
}