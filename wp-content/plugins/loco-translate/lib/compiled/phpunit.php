<?php
/**
 * Downgraded for PHP 5.6 compatibility. Do not edit.
 * @noinspection ALL
 */
class LocoDomQueryFilter { 
private  $tag = ''; 
private  $attr = []; 
public function __construct(  $value ){ $id = '[-_a-z][-_a-z0-9]*'; if( ! preg_match('/^([a-z1-6]*)(#'.$id.')?(\\.'.$id.')?(\\[(\\w+)="(.+)"])?$/i', $value, $r ) ){ throw new InvalidArgumentException('Bad filter, '.$value ); } if( $r[1] ){ $this->tag = $r[1]; } if( ! empty($r[2]) ){ $this->attr['id'] = substr($r[2],1); } if( ! empty($r[3]) ){ $this->attr['class'] = substr($r[3],1); } if( ! empty($r[4]) ){ $this->attr[ $r[5] ] = $r[6]; } } 
public function filter( DOMElement $el ) { if( '' !== $this->tag ){ $list = $el->getElementsByTagName($this->tag); $recursive = false; } else { $list = $el->childNodes; $recursive = true; } if( $this->attr ){ $list = $this->reduce( $list, new ArrayIterator, $recursive )->getArrayCopy(); } return $list; } 
public function reduce( DOMNodeList $list, ArrayIterator $reduced,  $recursive ) { foreach( $list as $node ){ if( $node instanceof DOMElement ){ $matched = false; foreach( $this->attr as $name => $value ){ if( ! $node->hasAttribute($name) ){ $matched = false; break; } $values = array_flip( explode(' ', $node->getAttribute($name) ) ); if( ! isset($values[$value]) ){ $matched = false; break; } $matched = true; } if( $matched ){ $reduced[] = $node; } if( $recursive && $node->hasChildNodes() ){ $this->reduce( $node->childNodes, $reduced, true ); } } } return $reduced; } }
class LocoDomQuery extends ArrayIterator { 
public static function parse(  $source ) { $dom = new DOMDocument('1.0', 'UTF-8' ); $dom->preserveWhitespace = true; $dom->formatOutput = false; $source = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body>'.$source.'</body></html>'; $used_errors = libxml_use_internal_errors(true); $opts = LIBXML_HTML_NODEFDTD; $parsed = $dom->loadHTML( $source, $opts ); $errors = libxml_get_errors(); $used_errors || libxml_use_internal_errors(false); libxml_clear_errors(); if( $errors || ! $parsed ){ $e = new Loco_error_ParseException('Unknown parse error'); foreach( $errors as $error ){ $e = new Loco_error_ParseException( trim($error->message) ); $e->setContext( $error->line, $error->column, $source ); if( LIBXML_ERR_FATAL === $error->level ){ throw $e; } } if( ! $parsed ){ throw $e; } } return $dom; } 
public function __construct( $value ){ if( $value instanceof DOMDocument ){ $value = [ $value->documentElement ]; } else if( $value instanceof DOMNode ){ $value = [ $value ]; } if( is_iterable($value) ){ $nodes = []; foreach( $value as $node ){ $nodes[] = $node; } } else if( is_string($value) || method_exists($value,'__toString') ){ $value = self::parse( $value ); $nodes = [ $value->documentElement ]; } else { $type = is_object($value) ? get_class($value) : gettype($value); throw new InvalidArgumentException('Cannot construct DOM from '.$type ); } parent::__construct( $nodes ); } 
public function eq( $index ) { $q = new LocoDomQuery([]); if( $el = $this[$index] ){ $q[] = $el; } return $q; } 
public function find( $value ) { $q = new LocoDomQuery( [] ); $f = new LocoDomQueryFilter($value); foreach( $this as $el ){ foreach( $f->filter($el) as $match ){ $q[] = $match; } } return $q; } 
public function children() { $q = new LocoDomQuery([]); foreach( $this as $el ){ if( $el instanceof DOMNode ){ foreach( $el->childNodes as $child ) { $q[] = $child; } } } return $q; } 
public function text(){ $s = ''; foreach( $this as $el ){ $s .= $el->textContent; } return $s; } 
public function html() { $s = ''; foreach( $this as $outer ){ foreach( $outer->childNodes as $inner ){ $s .= $inner->ownerDocument->saveXML($inner); } break; } return $s; } 
public function attr(  $name ) { foreach( $this as $el ){ return $el->getAttribute($name); } return null; } 
public function getFormData() { parse_str( $this->serializeForm(), $data ); return $data; } 
public function serializeForm() { $pairs = []; foreach( ['input','select','textarea','button'] as $type ){ foreach( $this->find($type) as $field ){ $name = $field->getAttribute('name'); if( ! $name ){ continue; } if( $field->hasAttribute('type') ){ $type = $field->getAttribute('type'); } if( 'select' === $type ){ $value = null; $f = new LocoDomQueryFilter('option'); foreach( $f->filter($field) as $option ){ if( $option->hasAttribute('value') ){ $_value = $option->getAttribute('value'); } else { $_value = $option->nodeValue; } if( $option->hasAttribute('selected') ){ $value = $_value; break; } else if( is_null($value) ){ $value = $_value; } } if( is_null($value) ){ $value = ''; } } else if( 'checkbox' === $type || 'radio' === $type ){ if( $field->hasAttribute('checked') ){ $value = $field->getAttribute('value'); } else { continue; } } else if( 'file' === $type ){ $value = ''; } else if( $field->hasAttribute('value') ){ $value = $field->getAttribute('value'); } else { $value = $field->textContent; } $pairs[] = sprintf('%s=%s', rawurlencode($name), rawurlencode($value) ); } } return implode('&',$pairs); } }
