<?php

namespace Svengerlach\Flake;

class Generator implements GeneratorInterface
{
    
    const NODE_IDENTIFIER_DEFAULT = 0;
    
    /** @var  TimerInterface */
    private $timer;
    
    /** @var  SequencerInterface */
    private $sequencer;

    /** @var  integer */
    private $epochStart;    

    /** @var  integer */
    private $nodeIdentifier = self::NODE_IDENTIFIER_DEFAULT;

    /**
     * Generator constructor.
     * 
     * @param TimerInterface $timer
     * @param SequencerInterface $sequencer
     * @param int $nodeIdentifier
     * @param int $epochStart
     */
    public function __construct(
        TimerInterface $timer, 
        SequencerInterface $sequencer,
        $epochStart, 
        $nodeIdentifier = self::NODE_IDENTIFIER_DEFAULT
    ) {
        $this->timer = $timer;
        $this->sequencer = $sequencer;

        if ( ! is_int($nodeIdentifier) || $nodeIdentifier < 0 || $nodeIdentifier > 1023 ) {
            throw new \InvalidArgumentException('Node identifier invalid, must be a 10 bit integer (between 0 and 1023)');
        }
        
        $this->nodeIdentifier = $nodeIdentifier;
        
        if ( ! is_int($epochStart) ) {
            throw new \InvalidArgumentException('Epoch start invalid, must be an integer');
        }
        
        $this->epochStart = $epochStart;
    }

    public function generate() 
    {
        $milliseconds = (int) floor($this->timer->getMilliseconds() - $this->epochStart);
        
        $value = ($milliseconds << 22) | ($this->nodeIdentifier << 12) | $this->sequencer->getNext($milliseconds);
        
        return (string)$value;        
    }

}