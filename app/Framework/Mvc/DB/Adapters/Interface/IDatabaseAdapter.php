<?php

interface IDatabaseAdapter
{
	public function getConnection();
	public function execute(String $sql, Array $params = []);
	public function query(String $sql, Array $params = []);
}