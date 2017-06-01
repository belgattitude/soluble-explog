<?php

declare(strict_types=1);

namespace ExpressiveLoggerApp\Action;

use Interop\Container\ContainerInterface;

class ExceptionActionFactory
{
    public function __invoke(ContainerInterface $container): ExceptionAction
    {
        return new ExceptionAction();
    }
}
