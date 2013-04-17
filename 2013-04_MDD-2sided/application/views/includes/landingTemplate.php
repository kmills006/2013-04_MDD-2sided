<?php

	// Header
	$this->load->view("includes/landingHeader.php");

	// Main Content
	if(isset($decks)){
		
		$this->load->view($view, $decks);
	
	}elseif(isset($usersDecks)){
	
		$this->load->view($view);

	}else{

	}

	// Footer
	$this->load->view("includes/landingFooter.php");

?>	