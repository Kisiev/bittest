<?php

class User extends Model
{
	public function findUserByLogin($login)
	{
		$user = $this->dbService->query("SELECT * FROM users WHERE login = ? LIMIT 1", [$login]);
		return reset($user);
	}
	public function findUserById($id)
	{
		$user = $this->dbService->query("SELECT * FROM users WHERE id = ? LIMIT 1", [$id]);
		return reset($user);
	}
}