<?php

class BaseController extends Controller
{
	use Auth;

	public $user;
	public function initialize()
	{
		if (!$this->isAuth())
			return;

		$users = new User();
		$this->user = $users->findUserById($this->getAuth());
	}
}