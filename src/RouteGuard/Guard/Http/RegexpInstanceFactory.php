<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard\Http;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegexpInstanceFactory implements FactoryInterface
{
    protected $creationOptions = array();

    public function __construct($options)
    {
        $this->setCreationOptions($options);
    }
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Zend\ServiceManager\AbstractPluginManager $serviceLocator */
        $options = $this->getCreationOptions();
        if (isset($options['assertion']) && is_string($options['assertion'])) {
            $sm = $serviceLocator->getServiceLocator();
            if ($sm->has($options['assertion'])) {
                $options['assertion'] = $sm->get($options['assertion']);
            }
        }
        return new Regexp($options);
    }

    public function setCreationOptions($options)
    {
        $this->creationOptions = $options;
    }

    public function getCreationOptions()
    {
        return $this->creationOptions;
    }

} 