<?php

declare(strict_types=1);

namespace ExpLogApp\Action;

use Interop\Container\ContainerInterface;

class ExceptionActionFactory
{
    public function __invoke(ContainerInterface $container): ExceptionAction
    {
        return new ExceptionAction();
    }
}
