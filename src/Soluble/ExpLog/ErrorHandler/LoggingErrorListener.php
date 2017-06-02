<?php

declare(strict_types=1);

namespace Soluble\ExpLog\ErrorHandler;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoggingErrorListener
{
    /**
     * Log format for messages:.
     *
     * STATUS [METHOD] path: message
     */
    const LOG_FORMAT = '%d [%s] %s: %s';

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \Throwable|\Exception $error
     */
    public function __invoke($error, ServerRequestInterface $request, ResponseInterface $response): void
    {
        $this->logger->error(sprintf(
            self::LOG_FORMAT,
            $response->getStatusCode(),
            $request->getMethod(),
            (string) $request->getUri(),
            $error->getMessage()
        ), $context = []);
    }
}
