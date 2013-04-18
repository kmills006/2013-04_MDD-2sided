<?
	
	$this->load->helper('objectToArray.php');
	$this->load->helper('isMulti.php');
	
	$decks = objectToArray($decks);
	
	if(!isMulti($decks)){
		// No
	}else{
		echo "<pre>";
		print_r($decks);
		echo "</pre>";
	}

?>