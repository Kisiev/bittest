<?php

class Controller
{
	function __construct()
	{
		$this->initialize();
	}
	public function initialize(){}
	public function view($viewName, $params = [])
	{
		$configApp = config('application');
		$viewDir = $configApp['viewDir'] . $viewName . '.php';
		foreach ($params as $varName => $param)
		{
			global $$varName;
			$$varName = $param;
		}
		require_once $viewDir;
	}
	public function jsonResult($data)
	{
		echo json_encode($data);
		return;
	}
}