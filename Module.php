<?php
/**
 * @copyright Lupimedia ltd 2013
 */

namespace RouteGuard;


use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements
    ConfigProviderInterface,
    AutoloaderProviderInterface,
    BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $event)
    {
        /** @var \RouteGuard\Guard\InstanceLoader $instanceLoader */

        $service = $event->getApplication()->getServiceManager()->get('RouteGuard');

        $em = $event->getApplication()->getEventManager();
        $em->attach(\Zend\Mvc\MvcEvent::EVENT_ROUTE, array($service, 'onRoute'));

    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

} 