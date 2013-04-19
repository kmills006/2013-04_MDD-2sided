<?php

	// Header
	$this->load->view("includes/landingHeader.php");

	// Main Content
	if(isset($decks)){
		
		$this->load->view($view, $decks);
	
	}elseif(isset($profileInfo)){

		$this->load->view($view, $profileInfo);

	}else{
		$this->load->view($view);
	}

	// Footer
	// $this->load->view("includes/footer.php");

?>	