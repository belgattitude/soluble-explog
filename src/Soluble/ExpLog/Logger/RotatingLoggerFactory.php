<?php

declare(strict_types=1);

namespace Soluble\ExpLog\Logger;

use Monolog\Handler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class RotatingLoggerFactory
{
    /**
     * @throws \Exception
     */
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        // @todo create variable in config
        //$config = $container->get('config');
        $log_file = 'data/log/explog.log';
        $days = 10;
        $level = Logger::INFO;

        $logger = new Logger('soluble-explog');
        $logger->pushProcessor(new PsrLogMessageProcessor());
        $logger->pushHandler(
            new Handler\RotatingFileHandler($log_file, $days, $level)
        );

        return $logger;
    }
}
