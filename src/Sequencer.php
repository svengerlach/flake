<?php

namespace Svengerlach\Flake;

class Sequencer implements SequencerInterface
{

    /** @var int */
    private $sequence = 0;
    
    private $lastMillisecond = 0;

    public function getNext($inMillisecond)
    {
        if ( $inMillisecond > $this->lastMillisecond ) {
            $this->sequence = 0;
            $this->lastMillisecond = $inMillisecond;
        }
        
        $this->sequence++;
        
        if ( $this->sequence > 4095 ) {
            throw new \OverflowException('Too many sequences generated within one millisecond');
        }

        return $this->sequence;
    }

}