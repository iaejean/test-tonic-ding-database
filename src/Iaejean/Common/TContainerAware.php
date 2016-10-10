<?php
declare(strict_types=1);

namespace Iaejean\Common;

use Ding\Container\IContainer;

/**
 * Class TContainerAware
 * @package Iaejean\Common
 */
trait TContainerAware
{
    /**
     * @var IContainer
     */
    protected $container;

    /**
     * @param IContainer $container
     */
    public function setContainer(IContainer $container)
    {
        $this->container = $container;
    }
}
