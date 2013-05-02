<?php

	// Header
	if(isset($_COOKIE['_clientInfo'])){ 

			$json = $_COOKIE['_clientInfo'];
			$obj = json_decode(stripslashes($json));

  			if($obj->{'browserWidth'} > 767){

  				$this->load->view("includes/loggedInHeader.php");

  			}else if($obj->{'browserWidth'} > 605){
  				$this->load->view("tablet/loggedInHeader.php");

  			}else{
  				$this->load->view("mobile/loggedInHeader.php");
  			}
	}else{
		$this->load->view("includes/loggedInHeader.php");
	}

	// Main Content
	$this->load->view($view);

	//Footer
	if($view == 'viewCards'){

	}else{
		$this->load->view("includes/footer.php");
	}

?>	