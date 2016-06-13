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
use Es\Services\ServiceLocator;

/**
 * The Collection of controllers. Provides controllers on demand.
 */
class Controllers extends ServiceLocator implements ControllersInterface
{
    /**
     * The class of exception, which should be raised if the requested controller
     * is not found.
     */
    const NOT_FOUND_EXCEPTION = 'Es\Controllers\Exception\ControllerNotFoundException';

    /**
     * The message of exception, that thrown when unable to find the requested
     * controller.
     *
     * @var string
     */
    const NOT_FOUND_MESSAGE = 'Not found; the Controller "%s" is unknown.';

    /**
     * The message of exception, that thrown when unable to build the requested
     * controller.
     *
     * @var string
     */
    const BUILD_FAILURE_MESSAGE = 'Failed to create the Controller "%s".';

    /**
     * The message of exception, that thrown when added of invalid
     * controller specification.
     *
     * @var string
     */
    const INVALID_ARGUMENT_MESSAGE = 'Invalid specification of Controller "%s"; expects string, "%s" given.';

    /**
     * Merges with other controllers.
     *
     * @param ControllersInterface $source The data source
     *
     * @return self
     */
    public function merge(ControllersInterface $source)
    {
        $this->registry  = array_merge($this->registry, $source->getRegistry());
        $this->instances = array_merge($this->instances, $source->getInstances());

        return $this;
    }
}
