<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard\Factory;

use RouteGuard\Guard\InstanceLoader;
use RouteGuard\Guard\GuardLoaderConfig;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GuardLoaderFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $config = new GuardLoaderConfig($config['guard']['instance_loader']);
        $loader = new GuardLoader($config);
        return $loader;
    }

} 