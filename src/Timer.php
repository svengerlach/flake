<?php

namespace Svengerlach\Flake;

class Timer implements TimerInterface
{

    /**
     * @return integer
     */
    public function getMilliseconds()
    {
        return (int) floor(microtime(true) * 1000);
    }

}