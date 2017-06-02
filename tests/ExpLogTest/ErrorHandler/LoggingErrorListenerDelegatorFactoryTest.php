<?php

declare(strict_types=1);

namespace ExpLogTest\ErrorHandler;

use ExpLogTest\TestAsset\DummyErrorHandler;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use Psr\Log\NullLogger;
use Soluble\ExpLog\ErrorHandler\ErrorHandlerLogger;
use Soluble\ExpLog\ErrorHandler\LoggingErrorListenerDelegatorFactory;
use Zend\Diactoros\Response\TextResponse;
use Zend\Stratigility\Middleware\ErrorHandler;

class LoggingErrorListenerDelegatorFactoryTest extends TestCase
{
    /** @var ContainerInterface|\Prophecy\Prophecy\ObjectProphecy */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    public function testListenerShouldBeAttached()
    {
        $this->container
            ->has(ErrorHandlerLogger::class)->willReturn(true);
        $this->container
            ->get(ErrorHandlerLogger::class)->willReturn(
                new NullLogger()
            );

        $errorHandler = new ErrorHandler(new TextResponse('Cool'));
        //$errorHandler = $this->prophesize(DummyErrorHandler::class);
        //$errorHandler->attachListener(Argument::any())->shouldBeCalled();

        $logFactory = new LoggingErrorListenerDelegatorFactory();

        $logListener = $logFactory($this->container->reveal(), 'test', function () use ($errorHandler) {
            return $errorHandler;
        });

        $this->assertInstanceOf(ErrorHandler::class, $logListener);

        //$logListener->process()
    }
}
