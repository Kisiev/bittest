<?php

class Model
{
	public $dbService;
	function __construct()
	{
		$adapterName = config('database')['adapter'];
		$this->dbService = new DbService($adapterName);
	}
}