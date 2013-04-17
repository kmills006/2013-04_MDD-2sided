<?php

include (APPPATH.'libraries/facebook/facebook.php');

class Fbconnect extends Facebook{

	public $user = null;
	public $userID = null;
	public $fb = false;
	public $fbSession = false; 
	public $appKey = 0;

	public function Fbconnect(){
		$ci =& get_instance();
		$ci->config->load('facebook', true);
		$config = $ci->config->item('facebook');

		parent::__construct($config);

		$this->userID = $this->getUser();
		$me = null;

		if($this->userID){
			try{
				$me = $this->api('/me');
				$this->user = $me;
			}catch(FacebookApiException $e){
				error_log($e);
			}
		}
	}

}