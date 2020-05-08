<?php

trait Auth
{
	private $error = '';
	public function clearError()
	{
		$this->error = '';
	}
	public function hasError()
	{
		return $this->error ? true : false;
	}
	public function authByLoginAndPassword ($login, $password)
	{
		$this->clearError();
		$users = new User();
		$user = $users->findUserByLogin($login);

		if (empty($user))
			return $this->error = 'invalid user';

		if ($user['password'] != md5($password))
			return $this->error = 'invalid password';

		$this->authById($user['id']);
		return $user;
	}
	public function authById($id)
	{
		$_SESSION['user'] = $id;
	}
	public function getAuth()
	{
		return $_SESSION['user'];
	}
	public function isAuth()
	{
		if (empty($_SESSION['user']))
			return false;
		return true;
	}
	public function clearUser()
	{
		unset($_SESSION['user']);
	}
}