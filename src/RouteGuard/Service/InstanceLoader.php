<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard;

use Zend\Di\ServiceLocator;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Exception;

class InstanceLoader extends AbstractPluginManager
{

    public function __construct(ConfigInterface $configuration)
    {
        parent::__construct($configuration);
    }

    public function factory($type, array $config)
    {
        return $this->get($type, $config, false);
    }


    /**
     * @param mixed $plugin
     * @return bool|void
     * @throws \RuntimeException
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof GuardInterface) {
            throw new \RuntimeException('Invalid plugin');
        }
        return true;
    }

} 