<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:36
 */

namespace Zf2Dash;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        // no more used, composer psr-4 autoloading is implemented
    }
}