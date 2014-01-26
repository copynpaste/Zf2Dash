<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:52
 */

namespace DashZf2\Router;

use Dash\Router\Http\Router;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Stdlib\RequestInterface as Request;

class RouterBridge implements RouteStackInterface
{
    /**
     * @var \Dash\Router\Http\Router
     */
    protected $dashRouter;

    function __construct(Router $dashRouter)
    {
        $this->setDashRouter($dashRouter);
    }

    /**
     * Create a new route with given options.
     *
     * @param  array|\Traversable $options
     * @return void
     * @throws \Exception
     */
    public static function factory($options = array())
    {
        throw new \Exception('I have no idea what this does');
        // @todo Understand what this does
    }

    /**
     * @return \Dash\Router\Http\Router
     */
    public function getDashRouter()
    {
        return $this->dashRouter;
    }

    /**
     * @param \Dash\Router\Http\Router $dashRouter
     */
    public function setDashRouter(Router $dashRouter)
    {
        $this->dashRouter = $dashRouter;
    }

    /**
     * Match a given request.
     *
     * @param  Request $request
     * @return RouteMatch|null
     */
    public function match(Request $request)
    {
        $dashRouteMatch = $this->dashRouter->match($request);
        if(is_null($dashRouteMatch)) {
            return null;
        }
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch($dashRouteMatch->getParams());
        $routeMatch->setMatchedRouteName($dashRouteMatch->getRouteName());

        return $routeMatch;
    }

    /**
     * Assemble the route.
     *
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = array(), array $options = array())
    {
        return $this->dashRouter->assemble($params, $options);
    }

    /**
     * Add a route to the stack.
     *
     * @param  string $name
     * @param  mixed $route
     * @param  int $priority
     * @return RouteStackInterface
     */
    public function addRoute($name, $route, $priority = null)
    {
        $this->dashRouter->getRouteCollection()->insert($name, $route, $priority);
        return $this;
    }

    /**
     * Add multiple routes to the stack.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function addRoutes($routes)
    {
        foreach ($routes as $name => $route) {
            $this->addRoute($name, $route);
        }
        return $this;
    }

    /**
     * Remove a route from the stack.
     *
     * @param  string $name
     * @return RouteStackInterface
     */
    public function removeRoute($name)
    {
        $this->dashRouter->getRouteCollection()->remove($name);
    }

    /**
     * Remove all routes from the stack and set new ones.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function setRoutes($routes)
    {
        $this->dashRouter->getRouteCollection()->clear();
        $this->addRoutes($routes);
    }

}