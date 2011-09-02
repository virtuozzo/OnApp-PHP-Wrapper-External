#!/usr/bin/env php
<?php

define( 'ROOT', dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR );

$tests_config_file = isset( $_SERVER[ 'argv' ][ 1 ] ) ? $_SERVER[ 'argv' ][ 1 ] : 'tests.ini';
$tests_config_file = ROOT . 'tests' . DIRECTORY_SEPARATOR . $tests_config_file;
if( !file_exists( $tests_config_file ) ) {
	exit( 'Can\'t open config file ' . $tests_config_file . PHP_EOL );
}
$tests_config = parse_ini_file( $tests_config_file );
$tests_config = $tests_config[ 'test_cases' ];

$tests = ROOT . 'tests' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
$check = array();
$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $tests ), RecursiveIteratorIterator::SELF_FIRST );
foreach( $files as $file ) {
	$test = str_replace( $tests, '', $file );
	$test = str_replace( '_TestCase.php', '', $test );
	if( !in_array( $test, $tests_config ) ) {
		$check[ ] = $file->getFilename();
	}
}

if( empty( $check ) ) {
	echo 'Everything is OK', PHP_EOL;
}
else {
	echo 'Following tests are missed in config file:', PHP_EOL;
	foreach( $check as $test ) {
		echo "\t", $test, PHP_EOL;
	}
}
