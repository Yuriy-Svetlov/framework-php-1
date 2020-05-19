<?php


return [

	'app' => [
		"lang" => "en",
		//'error_log' => '/var/log/php/php_errors.log'
		'error_log' => __DIR__ . '/../runtime/logs/error.log'
	],

	'debug_panel' => [
		'panel_url' => 'AdFGFggGHhhHHyhhhbfi9878IK/debug_panhel',
		'allow_ips' => ['127.0.0.1', '::1'],
	],

	'models' => [
		//'error_log' => '/var/log/php/errors_validation.log'
		'error_log' => __DIR__ . '/../runtime/logs/error_validation.log'
	],

	'logger' => [
		'default' => [
			'init' => true
		]
	]
	

];