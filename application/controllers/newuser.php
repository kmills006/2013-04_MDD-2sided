<?php

	class Newuser extends CI_Controller{
		function __construct(){
			parent:: __construct();
		}


		public function index(){
			$data["main_content"] = "login";
			$this->load->view("includes/landingTemplate", $data);
		}

		public function register(){
			$this->load->model("newuser_model");
			$this->load->model("user_model");

			// Form-Validation
			$this->load->library('form_validation');

			$config = array(
						array(
							"field" => "username",
							"label" => "Username",
							"rules" => "required|min_length[5]|max_length[20]"
						),
						array(
							"field" => "r-email",
							"label" => "Email",
							"rules" => "required"
						),
						array(
							"field" => "password",
							"label" => "Password",
							"rules" => "required|matches[r-c-password]"
						),
						array(
							"field" => "r-c-password",
							"label" => "Confirm Password",
							"rules" => "required"
						)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() == FALSE){
				echo "false";

				$data["main_content"] = "login";

				$this->load->view("includes/landingTemplate", $data);

			}else{
				$result = $this->user_model->validateNewUser();

				if(!$result){
					// Could not add user to database
				}else{
					// New user added
					redirect('user');
				}
			} 
		}
	}


?>