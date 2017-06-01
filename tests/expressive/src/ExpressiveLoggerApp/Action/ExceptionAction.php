<?php

declare(strict_types=1);

namespace ExpressiveLoggerApp\Action;

use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExceptionAction implements ServerMiddlewareInterface
{
    public function __construct()
    {
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate): ResponseInterface
    {
        throw new Exception('Exception action failed with exception, great !', 500);
    }
}
