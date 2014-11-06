<?php
/**
 * Use this file to override global defaults.
 *
 * See the individual environment DB configs for specific config information.
 */

return array(
	'default' => array(
		'type' => 'mysql',
		'connection'  => array(
			'host'       => 'localhost',
			'username'   => 'root',
			'password'   => 'testsql',
			'database'   => 'task',
		),
		'table_prefix' => '',
		'charset' => 'utf8',
	),
);
