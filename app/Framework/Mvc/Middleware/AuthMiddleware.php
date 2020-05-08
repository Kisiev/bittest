<?php

class AuthMiddleware implements IMiddleware
{
	use Auth;
	public function handler()
	{
		if (!$this->isAuth())
			return false;
		return true;
	}
}