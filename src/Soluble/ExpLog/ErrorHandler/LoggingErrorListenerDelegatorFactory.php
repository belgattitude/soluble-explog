<?php

declare(strict_types=1);

namespace Soluble\ExpLog\ErrorHandler;

use Psr\Container\ContainerInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class LoggingErrorListenerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, string $name, callable $callback): ErrorHandler
    {
        $errorHandler = $callback();

        if ($container->has(ErrorHandlerLogger::class)) {
            $listener = new LoggingErrorListener($container->get(ErrorHandlerLogger::class));
            $errorHandler->attachListener($listener);
        }

        return $errorHandler;
    }
}
