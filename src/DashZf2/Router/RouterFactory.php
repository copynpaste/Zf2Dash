<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:45
 */

namespace DashZf2\Router;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RouterFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return RouterBridge
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dashRouter = $serviceLocator->get('Dash\Router\Http\Router');
        return new RouterBridge($dashRouter);
    }
}