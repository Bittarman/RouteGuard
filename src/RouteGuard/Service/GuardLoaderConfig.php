<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Service;

use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceManager;

class GuardLoaderConfig implements ConfigInterface
{
    /**
     * @var array
     */
    protected $config = array();

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Configure service manager
     *
     * @param  ServiceManager $serviceManager
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

    /**
     * @param ServiceManager $serviceManager
     * @param                $config
     */
    public function configureFactories(ServiceManager $serviceManager, $config)
    {
        foreach ($config as $key => $value) {
            $serviceManager->setFactory($key, $value, false);
        }
    }

}
