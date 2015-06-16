<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'type' => 'mysqli',
		'connection'  => array(
			'host'       => 'localhost',
			'username'   => 'root',
			'password'   => '',
			'database'   => 'task',
		),
		'table_prefix' => '',
		'charset' => 'utf8',
	),
);
