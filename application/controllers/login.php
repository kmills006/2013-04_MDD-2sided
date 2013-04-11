<?php

class login extends CI_Controller {
		
		function __construct(){
			parent:: __construct();
		}


		public function index(){
			$data["main_content"] = "login";
			$this->load->view("includes/landingTemplate", $data);
		} // End of Index


		// facebookRequest
		public function facebookRequest(){
			$this->load->library('fbconnect');

			$data = array(
				'redirect_uri' => site_url('login/handleFacebookLogin'),
				'scope' => 'email'
			);

			redirect($this->fbconnect->getLoginUrl($data));
		}

		// handleFacebookLogin
		public function handleFacebookLogin(){
			// echo "Handle Facebook Login";

			$this->load->library('fbconnect');
			$this->load->model('user_model');

			if($this->fbconnect->user){
				// If user exists, check it against the database
				// If user is already in the database, direct them to their home page with all their decks
				// If user has never logged in before, add user to the database

				$facebookUser = $this->fbconnect->user;

				if($this->user_model->isMemeber($facebookUser)){

					$result = $this->user_model->login($facebookUser);

					if(!$result){
						// No Results Found
					}else{

						// Send user to logged in screen
						redirect("user");
					}
				
				}else{
					
					$result = $this->user_model->registerFromFacebook($facebookUser);

					if(!$result){

						// Could not add user to the database
						// Present error message
						echo $result;

					}else{
						$result = $this->user_model->login($facebookUser);
						
						if(!$result){
							// No Results Found
						}else{

							// Send user to logged in screen
							redirect("user");
						}						

					}
				}
			}else{
				echo "Could not log in at this time.";
			}

		}


		// process login
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