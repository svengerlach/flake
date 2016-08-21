<?php

namespace Svengerlach\Flake\Tests;

use Svengerlach\Flake\Generator, 
    Svengerlach\Flake\Sequencer, 
    Svengerlach\Flake\Timer;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{

    private function getSequencer() {
        $sequencer = \Mockery::mock('Svengerlach\Flake\SequencerInterface');
        $sequencer->shouldReceive('getNext')->andReturnValues(range(1, 100));
        
        return $sequencer;
    }
    
    private function getTimer() {
        $timer = \Mockery::mock('Svengerlach\Flake\TimerInterface');
        $timer->shouldReceive('getMilliseconds')->once()->andReturn(1471765656194);
        
        return $timer;
    }
    
    private function getGenerator($epochStart = 0, $nodeIdentifier = 0) {
        return new Generator(
            $this->getTimer(), 
            $this->getSequencer(), 
            $epochStart, 
            $nodeIdentifier
        );
    }
    
    public function testThrowsExceptionOnConstructIfNodeIdentifierIsSmallerThanZero() {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->getGenerator(0, -1);
    }
    
    public function testThrowsExceptionOnConstructIfNodeIdentifierIsGreaterThanZero() {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->getGenerator(0, 1024);
    }
    
    public function testThrowsExceptionOnConstructIfEpochStartIsNotAnInteger() {
        $this->setExpectedException(\InvalidArgumentException::class);
        $this->getGenerator('string');
    }
    
    public function testGenerationWithCustomEpochStart() {
        $generator = $this->getGenerator(1471765656194);
        
        $this->assertEquals(1, $generator->generate());
        $this->assertEquals(2, $generator->generate());
        $this->assertEquals(3, $generator->generate());
    }
    
}