<?php

class MysqlAdapter implements IDatabaseAdapter
{
	public $connection;
	public function __construct()
	{
		$this->connection = $this->getConnection();
	}
	public function getConnection()
	{
		$config = config('database');
		if (!empty($this->connection))
			return $this->connection;
		$connection = new mysqli (
			$config['host'],
			$config['username'],
			$config['password'],
			$config['dbname']
		);
		$connection->set_charset("utf8");
		return $connection;
	}
	public function execute(String $sql, Array $params = [])
	{
		foreach ($params as &$param)
			$param = $this->connection->real_escape_string($param);
		if (empty($this->connection))
			throw new Exception("connection error");

		$stmt = $this->connection->prepare($sql);

		if (empty($stmt))
			throw new Exception("Error Prepare sql");

		if (!empty($params))
			$stmt->bind_param(implode('', array_fill(0, count($params), 's')), ...$params);
		$stmt->execute();

		return true;
	}
	public function query(String $sql, Array $params = [])
	{
		foreach ($params as &$param)
			$param = $this->connection->real_escape_string($param);
		if (empty($this->connection))
			throw new Exception("connection error");

		$stmt = $this->connection->prepare($sql);

		if (empty($stmt))
			throw new Exception("Error Prepare sql");

		if (!empty($params))
			$stmt->bind_param(implode('', array_fill(0, count($params), 's')), ...$params);
		$stmt->execute();

		$result = $stmt->get_result();
		if (empty($result))
			throw new Exception("result error");

		$stmt->close();
		$rows = [];
		while ($row = $result->fetch_assoc())
			$rows[] = $row;

		return $rows;
	}
}