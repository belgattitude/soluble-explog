<?php

declare(strict_types=1);

namespace ExpLogTest\ErrorHandler;

use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Container\ContainerInterface;
use Soluble\ExpLog\ErrorHandler\ErrorHandlerLogger;
use Soluble\ExpLog\ErrorHandler\LoggingErrorListenerDelegatorFactory;
use Zend\Diactoros\Response\TextResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Stratigility\Middleware\ErrorHandler;
use Monolog\Logger;

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
        $testHandler = new \Monolog\Handler\TestHandler();
        $testLogger = new Logger('foo', [$testHandler]);

        $this->container
            ->has(ErrorHandlerLogger::class)->willReturn(true);
        $this->container
            ->get(ErrorHandlerLogger::class)->willReturn(
                $testLogger
            );

        $errorHandler = new ErrorHandler(new TextResponse('Cool'));

        $logFactory = new LoggingErrorListenerDelegatorFactory();

        $logFactory($this->container->reveal(), 'test', function () use ($errorHandler) {
            return $errorHandler;
        });

        /* @var DelegateInterface|\Prophecy\Prophecy\ObjectProphecy $delegate */
        $delegate = $this->prophesize(DelegateInterface::class);
        $delegate
            ->process(Argument::any())
            ->willThrow(new \Exception('Dummy exception', 500));

        $this->assertEmpty($testHandler->getRecords());
        $response = $errorHandler->process(new ServerRequest(), $delegate->reveal());
        $this->assertEquals(500, $response->getStatusCode());

        $this->assertNotEmpty($testHandler->getRecords());
        $this->assertTrue($testHandler->hasRecordThatMatches('/Dummy exception/', Logger::ERROR));
    }
}
