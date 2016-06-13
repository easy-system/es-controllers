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
use Es\Services\Services;
use Es\System\SystemConfig;

class ConfigureControllersListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetConfig()
    {
        $config   = new SystemConfig();
        $services = new Services();
        $services->set('Config', $config);
        $listener = new ConfigureControllersListener();
        $listener->setServices($services);
        $this->assertSame($config, $listener->getConfig());
    }

    public function testSetConfig()
    {
        $config   = new SystemConfig();
        $listener = new ConfigureControllersListener();
        $listener->setConfig($config);
        $this->assertSame($config, $listener->getConfig());
    }

    public function testGetControllers()
    {
        $controllers = new Controllers();
        $services    = new Services();
        $services->set('Controllers', $controllers);
        $listener = new ConfigureControllersListener();
        $listener->setServices($services);
        $this->assertSame($controllers, $listener->getControllers());
    }

    public function testSetControllers()
    {
        $controllers = new Controllers();
        $listener    = new ConfigureControllersListener();
        $listener->setControllers($controllers);
        $this->assertSame($controllers, $listener->getControllers());
    }

    public function testInvokeOnSuccess()
    {
        $controllersConfig = [
            'foo' => 'bar',
            'bat' => 'baz',
        ];
        $config                = new SystemConfig();
        $config['controllers'] = $controllersConfig;
        $controllers           = $this->getMock('Es\Controllers\Controllers');

        $listener = new ConfigureControllersListener();
        $listener->setControllers($controllers);
        $listener->setConfig($config);

        $controllers
            ->expects($this->once())
            ->method('add')
            ->with($this->identicalTo($controllersConfig));

        $listener(new ModulesEvent());
    }

    public function testInvokeDoesNothingIfControllersConfigurationNotExists()
    {
        $config      = new SystemConfig();
        $controllers = $this->getMock('Es\Controllers\Controllers');

        $listener = new ConfigureControllersListener();
        $listener->setControllers($controllers);
        $listener->setConfig($config);

        $controllers
            ->expects($this->never())
            ->method('add');

        $listener(new ModulesEvent());
    }
}
