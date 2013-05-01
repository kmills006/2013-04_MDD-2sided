<?php

	// Header
	if(isset($_COOKIE['_clientInfo'])){ 

			$json = $_COOKIE['_clientInfo'];
			$obj = json_decode(stripslashes($json));

  			if($obj->{'browserWidth'} > 767){

  				$this->load->view("includes/landingHeader.php");

  			}else if($obj->{'browserWidth'} > 605){
  				$this->load->view("tablet/landingHeader.php");

  			}else{
  				$this->load->view("mobile/landingHeader.php");
  			}
	}else{
		$this->load->view("includes/landingHeader.php");
	}

	// Main Content
	if(isset($decks)){
		
		$this->load->view($view, $decks);
	
	}elseif(isset($profileInfo)){

		$this->load->view($view, $profileInfo);

	}else{
		$this->load->view($view);
	}

	//Footer
	$this->load->view("includes/footer.php");

?>	