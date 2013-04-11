<?php

class login extends CI_Controller {
		
		function __construct(){
			parent:: __construct();
		}


		public function index(){
			$data["main_content"] = "login";
			$this->load->view("includes/landingTemplate", $data);
		} // End of Index


		public function facebook(){
			// Facebook Credentials
			$app_id = "517156441658987";
			$app_secret = "6a118834cf54a6a3f96345af2c0c087f";
			$app_url = base_url();

			$this->load->library('facebook');
			$user = $this->facebook->getUser();

			if($user){
	            try{
	                $data['user_profile'] = $this->facebook->api('/me');
	                $data['user_friends'] = $this->facebook->api('/me/friends');
	            } catch (FacebookApiException $e) {
	                $user = null;
	            }
	        }

	        if($user){
	            $data['logout_url'] = $this->facebook->getLogoutUrl();
	        } else {
	            $data['login_url'] = $this->facebook->getLoginUrl();
	        }

	        var_dump($user);
		}


		// process function
		public function process(){
			$this->load->model("login_model");
			
			// Form-Validation
			$this->load->library('form_validation');
			$config = array(
						array(
							"field" => "username",
							"label" => "Username",
							"rules" => "required"
						),
						array(
							"field" => "password",
							"label" => "Password",
							"rules" => "required"
						)
			);
			$this->form_validation->set_rules($config);

			// If the form validation fails, return users to login screen w/ form error
			if($this->form_validation->run() == FALSE){
				$data["main_content"] = "login";
				$this->load->view("includes/landingTemplate", $data);
			}else{
				// If passes, run login validation to check if user exists in db
				$results = $this->login_model->validate();

				// if user exists, load site; if not, load home page
				if($results){
					redirect("user");
				}else{
					redirect("login/loginerror");
				}
			}

		}
		public function usererror(){
			$this->index();
		}
		public function loginerror(){
			$this->index();
		}
}

?>