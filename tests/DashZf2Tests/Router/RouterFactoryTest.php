<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:47
 */

namespace DashZf2Test\Router;


use DashZf2\Router\RouterFactory;

class RouterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $factory = new RouterFactory();
        $mockServiceLocator = $this->getMock('Zend\ServiceManager\ServiceManager');
        $mockRouter = $this->getMock('Dash\Router\Http\Router', array(), array(), '', false);
        $mockServiceLocator->expects($this->once())->method('get')->with('Dash\Router\Http\Router')->will(
            $this->returnValue($mockRouter)
        );
        $this->assertInstanceOf('DashZf2\Router\RouterBridge', $factory->createService($mockServiceLocator));
    }
}
 