<?php
declare(strict_types=1);

namespace Iaejean\Common;

/**
 * Class TLoggerAware
 * @package Iaejean\Common
 */
trait TLoggerAware
{
    /**
     * @var \Logger
     */
    protected $logger;

    /**
     * @param \Logger $logger
     */
    public function setLogger(\Logger $logger)
    {
        $this->logger = $logger;
    }
}
