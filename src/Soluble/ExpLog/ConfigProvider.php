<?php

declare(strict_types=1);

namespace Soluble\ExpLog;

class ConfigProvider
{
    public const LOGGER = '\Soluble\ExpLog\ErrorHandlerLogger';

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
                    \Soluble\ExpLog\Listener\LoggingErrorListenerDelegatorFactory::class,
                ]
            ]
        ];
    }
}
