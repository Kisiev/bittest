<?php

class Dispatcher
{
	private $routes = [];

	private function getRouteByUrl($url)
	{
		foreach ($this->routes as $route => $routeParams)
		{
			if (preg_match("/^{$route}$/", $url))
				return $routeParams;
		}
		return [
			'controller' => 'index',
			'action'     => 'index'
		];
	}

	private function getControllerName($controllerName)
	{
		return ucfirst($controllerName) . 'Controller';
	}

	private function middleware($route)
	{
		if (empty($route['middleware']))
			return true;
		$middleware = ucfirst($route['middleware'] . 'Middleware');
		if (!class_exists($middleware))
			throw new Exception("Middleware not found");

		$middleware = new $middleware();
		if ($middleware->handler())
			return true;
		return false;
	}

	public function setRoutes(Array $routes)
	{
		$this->routes = $routes;
	}
	public function exectute()
	{
		session_start();
		$url = $_SERVER['REQUEST_URI'];
		$route = $this->getRouteByUrl($url);

		if (!$this->middleware($route))
			return false;

		$controllerName = $this->getControllerName($route['controller']);

		$controller = new $controllerName();
		call_user_func_array([$controller, $route['action']], []);
		session_write_close();
	}
}