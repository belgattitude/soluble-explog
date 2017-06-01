<?php

declare(strict_types=1);

namespace Soluble\ExpressiveLogger;

class ConfigProvider
{
    public const LOGGER = '\Soluble\ExpressiveLogger\ErrorHandlerLogger';

    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
            ],
            'delegators' => [
                \Zend\Stratigility\Middleware\ErrorHandler::class => [
                    \Soluble\ExpressiveLogger\Listener\LoggingErrorListenerDelegatorFactory::class,
                ]
            ]
        ];
    }
}
