<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('isMulti')){
   
	function isMulti($array) {
   		return (count($array) != count($array, 1));
	}
}