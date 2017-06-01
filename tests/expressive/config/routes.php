<?php

declare(strict_types=1);

use ExpLogApp\Action\ExceptionAction;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

/* @var \Zend\Expressive\Application $app */

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
    return (new JsonResponse(['success' => true]))->withStatus(200);
});

$app->get('/exception', [
    ExceptionAction::class
], 'exception-action');
