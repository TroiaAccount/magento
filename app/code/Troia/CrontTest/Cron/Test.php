<?php

namespace Troia\CrontTest\Cron;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Test
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->log(
            LogLevel::INFO,
            __METHOD__
        );
    }
}
