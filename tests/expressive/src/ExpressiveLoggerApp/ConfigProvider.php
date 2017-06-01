<?php

declare(strict_types=1);

namespace ExpressiveLoggerApp;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    public function getDependencies(): array
    {
        return [
            'factories' => [
                Action\ExceptionAction::class => Action\ExceptionActionFactory::class,
            ],
        ];
    }
}
