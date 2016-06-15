<?php
/**
 * This file is part of the "Easy System" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Damon Smith <damon.easy.system@gmail.com>
 */
namespace Es\Controllers\Test;

use Es\Controllers\Controllers;
use Es\Controllers\Listener\ConfigureControllersListener;
use Es\Modules\ModulesEvent;
use Es\System\SystemConfig;

class ConfigureControllersListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testInvokeOnSuccess()
    {
        $controllersConfig = [
            'foo' => 'bar',
            'bat' => 'baz',
        ];
        $config                = new SystemConfig();
        $config['controllers'] = $controllersConfig;
        $controllers           = $this->getMock(Controllers::CLASS);

        $listener = new ConfigureControllersListener();
        $listener->setControllers($controllers);
        $listener->setConfig($config);

        $controllers
            ->expects($this->once())
            ->method('add')
            ->with($this->identicalTo($controllersConfig));

        $listener(new ModulesEvent());
    }
}
