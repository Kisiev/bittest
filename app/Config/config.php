<?php

$config = [
	'database' => [
		'adapter'     => 'Mysql',
		'host'        => '<host>',
		'username'    => '<username>',
		'password'    => '<password>',
		'dbname'      => '<dbname>',
	],
	'application' => [
		'appDir'                 => __DIR__ . '/../',
		'serviceDir'             => __DIR__ . '/../Services/',
		'controllerDir'          => __DIR__ . '/../Controllers/',
		'modelDir'               => __DIR__ . '/../Models/',
		'viewDir'                => __DIR__ . '/../Views/',
		'frameworkDir'           => __DIR__ . '/../Framework/',
		'adapterInterfaceDir'    => __DIR__ . '/../Framework/Mvc/DB/Adapters/Interface/',
		'middlewareInterfaceDir' => __DIR__ . '/../Framework/Mvc/Middleware/Interface/',
		'traitsDir'              => __DIR__ . '/../Framework/Traits',
	]
];