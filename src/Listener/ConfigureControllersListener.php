<?php
/**
 * This file is part of the "Easy System" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Damon Smith <damon.easy.system@gmail.com>
 */
namespace Es\Controllers\Listener;

use Es\Modules\ModulesEvent;
use Es\Mvc\ControllersInterface;
use Es\Services\ServicesTrait;
use Es\System\ConfigInterface;

/**
 * Configures the system controllers.
 */
class ConfigureControllersListener
{
    use ServicesTrait;

    /**
     * The system configuration.
     *
     * @var \Es\System\Config
     */
    protected $config;

    /**
     * The system controllers.
     *
     * @var Es\Mvc\ControllersInterface
     */
    protected $controllers;

    /**
     * Sets the system configuration.
     *
     * @param \Es\System\ConfigInterface $config The system configuration
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * Gets the system configuration.
     *
     * @return \Es\System\Config The system configuration
     */
    public function getConfig()
    {
        if (! $this->config) {
            $services = $this->getServices();
            $config   = $services->get('Config');
            $this->setConfig($config);
        }

        return $this->config;
    }

    /**
     * Sets the controllers.
     *
     * @param \Es\Mvc\ControllersInterface $controllers The controllers
     */
    public function setControllers(ControllersInterface $controllers)
    {
        $this->controllers = $controllers;
    }

    /**
     * Gets the controllers.
     *
     * @return \Es\Mvc\ControllersInterface The controllers
     */
    public function getControllers()
    {
        if (! $this->controllers) {
            $services    = $this->getServices();
            $controllers = $services->get('Controllers');
            $this->setControllers($controllers);
        }

        return $this->controllers;
    }

    /**
     * Configures the system controllers.
     *
     * @param \Es\Modules\ModulesEvent $event
     */
    public function __invoke(ModulesEvent $event)
    {
        $controllers = $this->getControllers();
        $config      = $this->getConfig();
        if (! isset($config['controllers'])) {
            return;
        }
        $controllersConfig = (array) $config['controllers'];
        $controllers->add($controllersConfig);
    }
}
