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

use Es\Controllers\ControllersTrait;
use Es\Modules\ModulesEvent;
use Es\System\ConfigTrait;

/**
 * Configures the system controllers.
 */
class ConfigureControllersListener
{
    use ConfigTrait, ControllersTrait;

    /**
     * Configures the system controllers.
     *
     * @param \Es\Modules\ModulesEvent $event
     */
    public function __invoke(ModulesEvent $event)
    {
        $controllers = $this->getControllers();
        $config      = $this->getConfig();
        if (isset($config['controllers'])) {
            $controllersConfig = (array) $config['controllers'];
            $controllers->add($controllersConfig);
        }
    }
}
