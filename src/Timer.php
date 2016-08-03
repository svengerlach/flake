<?php

namespace Svengerlach\Flake;

class Timer implements TimerInterface
{

    /**
     * @return float
     */
    public function getMilliseconds()
    {
        return floor(microtime(true) * 1000);
    }


}