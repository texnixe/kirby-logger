<?php
use \Panel\Kirby\Logger;
return [
	'title' => [
		'text' => 'Logger',
		'link' => 'logger'
	],
	'options' => [
		[
			'icon' => 'table',
			'link' => 'logger',
			'text' => 'Logger View'
		]
	],
	'html' => function() {
    $filepath = c::get('logger.filepath', panel()->site()->kirby()->roots()->index() . DS . "logger/log.txt");
		return tpl::load(__DIR__ . DS .'logger.html.php', array('logger' => logger()));
	}
];
