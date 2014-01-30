<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard\Http\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use RouteGuard\Guard\Http\Regexp;

class RegexpGuardFactory implements FactoryInterface, GuardFactoryInterface
{
    /**
     * @var array
     */
    protected $creationOptions = array();

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setCreationOptions($options);
    }
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\ServiceManager\AbstractPluginManager $serviceLocator */
        $options = $this->getCreationOptions();
        if (isset($options['assertion']) && is_string($options['assertion'])) {
            $serviceManager = $serviceLocator->getServiceLocator();
            if ($serviceManager->has($options['assertion'])) {
                $options['assertion'] = $serviceManager->get($options['assertion']);
            }
        }

        return new Regexp($options);
    }

    /**
     * @param array $options
     */
    public function setCreationOptions($options)
    {
        $this->creationOptions = $options;
    }

    /**
     * @return array
     */
    public function getCreationOptions()
    {
        return $this->creationOptions;
    }

}
