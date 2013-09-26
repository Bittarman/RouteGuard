<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard;


use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

class GuardLoaderConfig implements ConfigInterface
{
    protected $config = array();

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Configure service manager
     *
     * @param ServiceManager $serviceManager
     * @return void
     */
    public function configureServiceManager(ServiceManager $serviceManager)
    {
        foreach ($this->config as $key => $value) {
            switch ($key) {
                case 'factories':
                    $this->configureFactories($serviceManager, $value);
                    break;
            }
        }
    }

    public function configureFactories(ServiceManager $sm, $config)
    {
        foreach ($config as $key => $value) {
            $sm->setFactory($key, $value, false);
        }
    }

} 