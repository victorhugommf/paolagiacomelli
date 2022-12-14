<?php

namespace WC_Juno\functions;

function value ( $value, $default = '' ) {
	$result = is_callable( $value ) ? call_user_func( $value ) : $value;
	return empty( $result ) ? $default : $result;
}

// returns a value of a global array if it exists or an empty string
// example: request_value( 'foo', 'post' ) returns $_POST['foo']
function request_value ( $key, $type = '' ) {
	if ( empty( $type ) ) $type = $_SERVER['REQUEST_METHOD'];
	$array = $GLOBALS[ '_' . strtoupper( $type ) ];
	return array_get( $array, $key, '' );
}

function throw_if ( $condition, $exception, ...$parameters ) {
	if ( $condition ) {
		if ( ! $exception ) {
			$exception = \Exception::class;
		}
		throw is_string( $exception ) ? new $exception( ...$parameters ) : $exception;
	}
	return $condition;
}

// for debug
function dd ( $data ) {
	var_dump( $data );
	die(1);
}