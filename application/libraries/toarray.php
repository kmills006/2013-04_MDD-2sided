<?php
	

 	class Toarray{

 		function __construct()
	    {
	        parent::__construct();
	    }

	    
 		// objecToArray Function to convert stdObject to multidimensional array
		public function objectToArray($a){

			echo "here";
			if(is_object($a)){
				// Gets the property of the given object
				// with the object_get_vars function
				$a = get_object_vars($a);
				return $a;
			}if(is_array($a)){
				// Return array converted to object
				// Using __FUNCTION__ (Magic constant)
				// for recursive call
				return array_map(__FUNCTION__, $a);
			}else{
				return $a;
			}
		}
 	}
?>