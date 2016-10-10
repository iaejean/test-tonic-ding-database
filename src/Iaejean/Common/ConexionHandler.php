<?php
declare(strict_types=1);

namespace Iaejean\Common;

use Ding\Logger\ILoggerAware;
use Illuminate\Database\Capsule\Manager;

/**
 * Class AbstractDao
 * @package Iaejean\Common
 *
 * @Component(name=ConexionHandler)
 * @Singleton
 */
class ConexionHandler implements ILoggerAware
{
    /**
     * @var array
     * @Value(value="${database.config}")
     */
    protected $config;
    /**
     * @var Manager
     */
    protected $manager;
    use TLoggerAware;

    /**
     * @PostConstruct
     */
    public function init()
    {
        $this->manager = new Manager();
        $this->manager->addConnection($this->config);
        $this->manager->setAsGlobal();
    }

    /**
     * @return Manager
     */
    public function getManager(): Manager
    {
        return $this->manager;
    }
}
