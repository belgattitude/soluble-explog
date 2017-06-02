<?php

declare(strict_types=1);

namespace ExpLogTest;

use PHPUnit\Framework\TestCase;
use Soluble\ExpLog\ConfigProvider;
use Soluble\ExpLog\ErrorHandler\ErrorHandlerLogger;
use Soluble\ExpLog\ErrorHandler\LoggingErrorListenerDelegatorFactory;
use Soluble\ExpLog\Logger\LoggerServiceFactory;
use Zend\Stratigility\Middleware\ErrorHandler;

class ConfigProviderTest extends TestCase
{
    public function testReturnExpectedDependencies(): void
    {
        $config = (new ConfigProvider())->__invoke();

        $this->assertArrayHasKey('dependencies', $config);

        // dependencies
        $dependencies = $config['dependencies'];
        $this->assertArrayHasKey('factories', $dependencies);
        $factories = $dependencies['factories'];

        $this->assertCount(1, $factories);
        $this->assertArrayHasKey(ErrorHandlerLogger::class, $factories);

        $this->assertSame(
            LoggerServiceFactory::class,
            $factories[ErrorHandlerLogger::class]
        );

        // delegators
        $this->assertArrayHasKey('delegators', $dependencies);
        $delegators = $dependencies['delegators'];

        $this->assertCount(1, $delegators);

        $this->assertArrayHasKey(ErrorHandler::class, $delegators);

        $this->assertSame(
            [LoggingErrorListenerDelegatorFactory::class],
            $delegators[ErrorHandler::class]
        );
    }
}
