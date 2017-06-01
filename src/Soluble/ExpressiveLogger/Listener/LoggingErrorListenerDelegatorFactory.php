<?php

declare(strict_types=1);

namespace Soluble\ExpressiveLogger\Listener;

use Psr\Container\ContainerInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

class LoggingErrorListenerDelegatorFactory
{
    public function __invoke(ContainerInterface $container, $name, callable $callback): ?ErrorHandler
    {
        if (!$container->has(ErrorHandler::class)) {
            return null;
        }

        $listener = new LoggingErrorListener($container->get('Soluble\ExpressiveLogger\ErrorHandlerLogger'));
        $errorHandler = $callback();
        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
