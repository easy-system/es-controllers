<?php
/**
 * This file is part of the "Easy System" package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Damon Smith <damon.easy.system@gmail.com>
 */
namespace Es\Controllers;

use Es\Mvc\ControllersInterface;
use Es\Services\Provider;

/**
 * The recommended way to interact with controllers.
 */
trait ControllersTrait
{
    /**
     * Sets the controllers.
     *
     * @param \Es\Mvc\ControllersInterface $controllers The controllers
     */
    public function setControllers(ControllersInterface $controllers)
    {
        Provider::getServices()->set('Controllers', $controllers);
    }

    /**
     * Gets the controllers.
     *
     * @return \Es\Mvc\ControllersInterface The controllers
     */
    public function getControllers()
    {
        return Provider::getServices()->get('Controllers');
    }
}
