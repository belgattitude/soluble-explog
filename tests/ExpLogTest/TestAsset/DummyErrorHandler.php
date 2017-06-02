<?php

declare(strict_types=1);

namespace ExpLogTest\TestAsset;

class DummyErrorHandler
{
    /**
     * @var array
     */
    protected $listeners = [];

    public function attachListener(callable $listener)
    {
        if (in_array($listener, $this->listeners, true)) {
            return;
        }
        $this->listeners[] = $listener;
    }
}
