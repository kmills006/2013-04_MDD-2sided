<?php

include (APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook{

	public function Fbconnect(){
		$ci =& get_instance();

		$ci->config->load('facebook', TRUE);

		// Pulling the appID and appSecret from the config file
		$config = $ci->config->item('facebook');

		parent::__construct($config);
	}

}