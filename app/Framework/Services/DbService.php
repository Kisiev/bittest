<?php

class DbService
{
	private $adapter;
	public function __construct($adapter)
	{
		$adapter = ucfirst($adapter) . 'Adapter';
		if (!class_exists($adapter))
			throw new Exception("Adapter not found");
		$this->adapter = new $adapter();
	}
	public function getAdapter()
	{
		return $this->adapter;
	}
	public function query($sql, $params = [])
	{
		return $this->adapter->query($sql, $params);
	}
	public function execute($sql, $params = [])
	{
		return $this->adapter->execute($sql, $params);
	}
}