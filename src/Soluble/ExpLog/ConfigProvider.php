<?php

declare(strict_types=1);

namespace Soluble\ExpLog;

use Soluble\ExpLog\ErrorHandler\ErrorHandlerLogger;
use Soluble\ExpLog\ErrorHandler\LoggingErrorListenerDelegatorFactory;
use Soluble\ExpLog\Logger\LoggerServiceFactory;

class ConfigProvider
{
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
                ErrorHandlerLogger::class => LoggerServiceFactory::class
            ],
            'delegators' => [
                \Zend\Stratigility\Middleware\ErrorHandler::class => [
                    LoggingErrorListenerDelegatorFactory::class
                ]
            ]
        ];
    }
}
