<?php

function registerDirFiles($dir)
{
	foreach (glob($dir . '*') as $dirItem)
	{
		if (is_dir($dirItem))
		{
			registerDirFiles("{$dirItem}/");
			continue;
		}
		require_once $dirItem;
	}
}

$loader = [];
$loader[] = $config['application']['adapterInterfaceDir'];
$loader[] = $config['application']['middlewareInterfaceDir'];
$loader[] = $config['application']['traitsDir'];

$loader[] = $config['application']['frameworkDir'];
$loader[] = $config['application']['controllerDir'];
$loader[] = $config['application']['modelDir'];

foreach ($loader as $dir)
	registerDirFiles($dir);