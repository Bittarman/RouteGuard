<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link      https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license   https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Service\Factory;

use RouteGuard\Service\RouteGuard;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouteGuardFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     *
     * @return \RouteGuard\Service\RouteGuard
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /**
         * @var array                              $config
         * @var \RouteGuard\Service\InstanceLoader $loader
         */
        $config      = $serviceLocator->get('config');
        $guardConfig = isset($config['guards']) ? $config['guards'] : [];
        $loader      = $serviceLocator->get('RouteGuard\Service\InstanceLoader');
        $service     = new RouteGuard($guardConfig, $loader);

        return $service;
    }

}
