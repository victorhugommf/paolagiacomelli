<?php

namespace WC_Juno\functions;

use WC_Juno\Core\Config;
use WC_Juno\Utils\Asset_Manager;

function config_set ( $key, $value ) {
	return Config::set( $key, $value );
}

function config_get ( $key, $default = null ) {
	return Config::get( $key, $default );
}

function prefix ( $string = '' ) {
	return Config::get( 'PREFIX' ) . $string;
}

function assets ( $string = '' ) {
	$assets = Config::get( '$assets', false );
	if ( false === $assets ) {
		$assets = Config::set( '$assets', new Asset_Manager() );
		$assets->add_hooks();
	}
	return $assets;
}
