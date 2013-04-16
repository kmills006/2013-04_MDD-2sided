<?php

	/*  Bits of code while testing and learning CodeIgniter
		This file will never run
		Only to help remember new code
		--------------------------------------------------
		--------------------------------------------------
		------------------------------------------------ */
	
	
	
	
	/* Working with the Database
	----------------------------
	----------------------------
	--------------------------*/
	
	$this->load->database();

	$query = $this->db->query("SELECT *
							   FROM users");
	
	// echos out all users username, password and email that is being returned from the database
	// each time the loop goings around it will print out on row (1 user)	
	foreach ($query->result() as $row)
	{
	    echo $row->username;
	    echo "<br/>";
	    echo $row->pword;
	    echo "<br/>";
	    echo $row->email;
	}

?>>


<?php

	// DO NOT LOSE!!!!!!!!!! THIS GOES IN THE LOGIN.PHP CONTROLLER TO VALIDATE AND CHECK THE USER
			/* $this->load->model("login_model");
			 $results = $this->login_model->validate();

			if($results){
				redirect("site/user");
			}else{
				$this->index();
			} /* 









?>






<!-- TRYING TO FIGURE OUT FORM VALIDATION FROM CI
 			$this->load->helper('form');
			$this->load->library('form_validation');

			// setting required fields
			$config = array(
						array(
							"field" => "ln-username",
							"label" => "Username",
							"rules" => "required"
						),
						array(
							"field" => "ln-password",
							"label" => "Password",
							"rules" => "required"
						),
						array(
							"field" => "r-username",
							"label" => "Username",
							"rules" => "required|min_length[6]|max_length[20]"
						),
						array(
							"field" => "r-email",
							"label" => "Email",
							"rules" => "required"
						),
						array(
							"field" => "r-password",
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

		if ($this->form_validation->run() == FALSE){
			echo "FALSE";
		}else{
			echo "validated!";
		} -->




<!-- public function validate(){
        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        
        // Run the query
        $query = $this->db->get('users');
        // Let's check if there are any results
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'userid' => $row->userid,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'username' => $row->username,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    } -->








    /* SELECT *
FROM cards as c
JOIN decks as d
ON c.deck_id = d.deck_id
WHERE c.deck_id = "50efe6058c9c1";




$this->db->select('*');
$this->db->from('blogs');
$this->db->join('comments', 'comments.id = blogs.id');

$query = $this->db->get();

// Produces: 
// SELECT * FROM blogs
// JOIN comments ON comments.id = blogs.id*/