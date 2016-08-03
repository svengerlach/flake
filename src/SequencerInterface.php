<?php

namespace Svengerlach\Flake;

interface SequencerInterface
{
    
    public function getNext($inMillisecond);

}