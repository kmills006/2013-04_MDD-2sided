<?php

	// Header
	$this->load->view("includes/landingHeader.php");

	// Main Content
	if($decks){
		$this->load->view($view, $decks);
	}else{

	}

	// Footer
	$this->load->view("includes/landingFooter.php");

?>	