<?php

class IndexController extends BaseController
{
	public function index()
	{
		$this->view('auth');
	}
	public function logout()
	{
		$this->clearUser();
		header('Location: /');
	}
	public function auth()
	{
		$login    = $_POST['login'];
		$password = $_POST['password'];

		if (empty($login) || empty($password))
			return $this->jsonResult(['success' => false, 'msg' => 'required fields is empty']);

		$authResult = $this->authByLoginAndPassword($login, $password);
		if ($this->hasError())
			return $this->jsonResult(['success' => false, 'msg' => $authResult]);

		return $this->jsonResult(['success' => true]);
	}
	public function lk($value='')
	{
		$this->view('lk', ['user' => $this->user]);
	}
	public function takeMoney()
	{
		$amount = $_POST['amount'];

		if (empty($amount) || intval($amount) <= 0)
			return $this->jsonResult(['success' => false, 'msg' => 'invalid args']);

		$dbService = new DbService(config('database')['adapter']);
		$connection = $dbService->getAdapter()->getConnection();
		try {
			$connection->autocommit(false);
			$connection->begin_transaction();
			$user = $dbService->query("SELECT * FROM users WHERE id = ? LIMIT 1 FOR UPDATE", [$this->user['id']]);

			$user = reset($user);
			if (intval($user['balance']) - intval($amount) >= 0)
			{
				$user['balance'] = $user['balance'] - intval($amount);
				$dbService->execute("UPDATE users SET balance = ? WHERE id = ?", [$user['balance'], $user['id']]);
			}
			else
				return $this->jsonResult(['success' => false, 'msg' => 'not enough mana']);
		} catch (Exception $e) {
			$connection->rollback();
			return $this->jsonResult(['success' => false, 'msg' => 'some error']);
		}
		$connection->commit();
		$connection->close();
		return $this->jsonResult(['success' => true]);
	}
}