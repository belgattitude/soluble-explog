<?php


use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;

return [
    'dependencies' => [
        'factories' => [
            \Soluble\ExpLog\ErrorHandler\ErrorHandlerLogger::class => function (\Psr\Container\ContainerInterface $container) {
                $log_file = 'data/log/test-logger.log';
                $logger = new Logger('explog-test-logger');
                $logger->pushProcessor(new PsrLogMessageProcessor());
                $logger->pushHandler(
                    new \Monolog\Handler\StreamHandler($log_file, Logger::INFO)
                );

                return $logger;
            }
        ]
    ]
];
