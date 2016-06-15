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
use Es\Services\Provider;
use Es\Services\Services;

class ControllersTraitTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        require_once 'ControllersTraitTemplate.php';
    }

    public function testSetControllers()
    {
        $controllers = new Controllers();
        $template    = new ControllersTraitTemplate();
        $template->setControllers($controllers);
        $this->assertSame($controllers, $template->getControllers());
    }

    public function testGetControllers()
    {
        $controllers = new Controllers();
        $services    = new Services();
        $services->set('Controllers', $controllers);

        Provider::setServices($services);
        $template = new ControllersTraitTemplate();
        $this->assertSame($controllers, $template->getControllers());
    }
}
