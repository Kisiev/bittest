<?php
$routes = [
	'\/' => [
		'controller' => 'index',
		'action'     => 'index'
	],
	'\/auth\/?' => [
		'controller' => 'index',
		'action'     => 'auth'
	],
	'\/lk\/?' => [
		'controller' => 'index',
		'action'     => 'lk',
		'middleware' => 'auth'
	],
	'\/takeMoney\/?' => [
		'controller' => 'index',
		'action'     => 'takeMoney',
		'middleware' => 'auth'
	],
	'\/logout\/?' => [
		'controller' => 'index',
		'action'     => 'logout',
		'middleware' => 'auth'
	],
];