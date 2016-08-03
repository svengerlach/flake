<?php

namespace Svengerlach\Flake;

interface GeneratorInterface
{
    
    /**
     * @return integer
     */
    public function generate();
    
}