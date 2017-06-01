<?php

declare(strict_types=1);

namespace ExpLogTest;

use PHPUnit\Framework\TestCase;
use Soluble\ExpLog\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    public function testProvider(): void
    {
        $config = (new ConfigProvider())->__invoke();
        $this->assertArrayHasKey('dependencies', $config);
    }
}
