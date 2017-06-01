<?php

declare(strict_types=1);

namespace ExpressiveLoggerSmokeTest;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ExceptionActionTest extends TestCase
{
    /** @var Client */
    private $client;

    /**
     * @var string
     */
    private $test_log_file;

    protected function setUp()
    {
        $this->client = new Client([
            'base_uri' => sprintf('http://%s:%s', WEB_SERVER_HOST, WEB_SERVER_PORT),
            'timeout'  => 5,
        ]);

        $this->test_log_file = dirname(__DIR__) . '/expressive/data/log/test-logger.log';
        $this->cleanLogFile($this->test_log_file);
    }

    /**
     * @group        functional
     */
    public function testExceptionActionShouldBeLogged(): void
    {
        $this->assertFileNotExists($this->test_log_file);

        $response = $this->client->request('GET', '/exception', [
            'exceptions' => false
        ]);

        $this->assertEquals(500, $response->getStatusCode());

        $this->assertFileExists($this->test_log_file);
        $filecontent = file_get_contents($this->test_log_file);
        $this->assertContains('Exception action failed with exception', $filecontent);
    }

    protected function cleanLogFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
