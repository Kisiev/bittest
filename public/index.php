<?php

try {
	include __DIR__ . "/../app/Config/config.php";
	include __DIR__ . "/../app/Config/routes.php";
	include __DIR__ . "/../app/Config/bootstrap.php";

	$dispatcher = new Dispatcher();
	$dispatcher->setRoutes($routes);
	$dispatcher->exectute();
} catch (\Exception $e) {
	echo $e->getMessage();
}
