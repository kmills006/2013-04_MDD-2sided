<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('objectToArray')){
   
	function objectToArray($a){
		if(is_object($a)){	
			$a = get_object_vars($a);
			return $a;
		}if(is_array($a)){
			return array_map(__FUNCTION__, $a);
		}else{
			return $a;
		}
	}
}