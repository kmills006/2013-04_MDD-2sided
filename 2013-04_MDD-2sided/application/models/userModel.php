<?

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }


    // getProfile 
    // Get all of users information and load their profile page
    function getProfile($userID){
    	
    	$this->load->library('subquery');

    	$this->db->select("u.user_id, u.username, u.date_of_reg, u.profile_img");
	 
	   	$subDecks = $this->subquery->start_subquery("select");
		$subDecks->select('COUNT(d.deck_id) as deck_count')->from('users as u');
		$subDecks->join('decks as d', 'u.user_id = d.user_id');
		$subDecks->where("u.user_id = '$userID'");
		$this->subquery->end_subquery('decksCount');

    	$subCards = $this->subquery->start_subquery("select");
    	$subCards->select('COUNT(c.card_id) as card_count')->from('users as u');
    	$subCards->join('decks as d', 'u.user_id = d.user_id');
    	$subCards->join('cards as c', 'd.deck_id = c.deck_id');
		$subCards->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('cardsCount');

    	$subTags = $this->subquery->start_subquery("select");
    	$subTags->select('COUNT(t.tag_id) as tag_count')->from('users as u');
    	$subTags->join('decks as d', 'u.user_id = d.user_id');
    	$subTags->join('tags as t', 'd.deck_id = t.deck_id');
		$subTags->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('tagsCount');

    	$subFriends = $this->subquery->start_subquery("select");
    	$subFriends->select('COUNT(uf.friend_id) as friend_count')->from('users as u');
    	$subFriends->join('user_friends as uf', 'u.user_id = uf.user_id');
		$subFriends->where("u.user_id = ", $userID);
        $subFriends->where('uf.active', "1");
        $subFriends->or_where('uf.friend_id', $userID);
        $subFriends->where('uf.active', 1);
    	$this->subquery->end_subquery('friendsCount');

    	$subRatings = $this->subquery->start_subquery("select");
    	$subRatings->select('COUNT(r.rating_id) as rating_count')->from('users as u');
    	$subRatings->join('decks as d', 'u.user_id = d.user_id');
    	$subRatings->join('ratings as r', 'd.deck_id = r.deck_id');
		$subRatings->where("u.user_id = '$userID'");
    	$this->subquery->end_subquery('ratingsCount');

        $subBadges = $this->subquery->start_subquery("select");
        $subBadges->select('COUNT(user_badge_id) as badge_count')->from('users as u');
        $subBadges->join('user_badges as ub', 'u.user_id = ub.user_id');
        $subBadges->where("u.user_id = '$userID'");
        $this->subquery->end_subquery('badgeCount');

        $subProfileCount = $this->subquery->start_subquery("select");
        $subProfileCount->select('count')->from('profile_views');
        $subProfileCount->where("user_id = '$userID'");
        $this->subquery->end_subquery('profileCount');

    	$this->db->from('users as u');
    	$this->db->where("u.user_id = '$userID'");

		$query = $this->db->get();


    	 if($query->num_rows > 0){
    		foreach($query->result() as $row){
    			$dataResults[] = $row;
    		}
    	}else{
    		// No Results Found
    		echo "No Results";
    	}

        // echo '<pre>';
        // print_r($dataResults);
        // echo '</pre>';

    	if(isset($dataResults)){

            $dataResults = objectToArray($dataResults);

    		return $dataResults;

    	}else{
    		return false;
    	} 
    }

    // increaseUserViewCount
    // Everytime someone views a users profile, increase their profile view count
    function increaseUserViewCount($viewerID, $profileOwnerID){
        $profileID = uniqid();

        // Select profile view by the ownersID
        $this->db->select();
        $this->db->where('user_id', $profileOwnerID);
        $query = $this->db->get('profile_views');

        // If it already has a profile view
        // Add count depending on if and when
        // the viewer last visited
        if($query->num_rows() > 0){
            $row = objectToArray($query->result());
            
            $this->db->select();
            $this->db->where('user_id', $viewerID);
            $this->db->where('profile_id', $row[0]['profile_id']);
            $this->db->order_by('view_date', 'desc');
            $this->db->limit(1);
            $result = $this->db->get('pages');

            if($result->num_rows() > 0 ){
                // User has viewed this profile before
                // check if in a 24 hour period
                // only update count if past 24 hours
                
                $lastVote = objectToArray($result->result());

                // Create two new DateTime-objects...
                $date1 = new DateTime($lastVote[0]['view_date']);
                $date2 = new DateTime(date('Y/m/d h:i:s', time()));

                // The diff-methods returns a new DateInterval-object...
                $diff = $date2->diff($date1);


                // Call the format method on the DateInterval-object
                $timeDiff = $diff->format('%h');
                
                if($timeDiff < 24){
                    // User has viewed this profile in the past 24 hours,
                    // do not update profile count
                }else{
                    // Add one new view from that user to 
                    // pages table
                    
                    $newPageView = array(
                                    'pages_id' => uniqid(),
                                    'profile_id' => $row[0]['profile_id'],
                                    'user_id' => $viewerID,
                                    'view_date' => date('Y/m/d h:i:s', time())
                    );

                    $this->db->insert('pages', $newPageView);

                    // Add one new count to the profile view
                    $this->db->query(
                            'UPDATE profile_views
                            SET count = count + 1
                            WHERE profile_id = "'.$row[0]['profile_id'].'"'
                    );
                }

            }else{
                // User has not viewed this profile before                
                $newPageView = array(
                                'pages_id' => uniqid(),
                                'profile_id' => $row[0]['profile_id'],
                                'user_id' => $viewerID,
                                'view_date' => date('Y/m/d h:i:s', time())
                );

                $this->db->insert('pages', $newPageView);

                $this->db->query(
                            'UPDATE profile_views
                            SET count = count + 1
                            WHERE profile_id = "'.$row[0]['profile_id'].'"'
                );
            }
        }else{
            // Adding new profile view 
            $newProfileView = array(
                                'profile_id' => $profileID,
                                'user_id' => $profileOwnerID,
                                'count' => 1
            );

            $this->db->insert('profile_views', $newProfileView);


            // Adding new page view for logged in user
            $newPageView = array(
                            'pages_id' => uniqid(),
                            'profile_id' => $profileID,
                            'user_id' => $viewerID,
                            'view_date' => date('Y/m/d h:i:s', time())
            );

            $this->db->insert('pages', $newPageView);
        }

    }


    // getAll
    // Retrieve all users and their ratings count from database for users page
    function getAll($sortBy){

        $this->db->select('user_id');
        $query = $this->db->get('users');

        if($query->num_rows > 0){
            foreach($query->result() as $row){

                $this->db->select("u.user_id, username, profile_img, COUNT(r.rating_id) as ratingCount, u.date_of_reg");
                $this->db->join('decks as d', 'u.user_id = d.user_id');
                $this->db->join('ratings as r', 'd.deck_id = r.deck_id');
                $this->db->where('u.user_id', $row->user_id);

                $q = $this->db->get('users as u');


                if($q->num_rows() > 0){
                    
                    foreach($q->result() as $r){
                        $dataResults[] = $r; 
                    }

                }else{
                    // No Results Found
                }

            } // end of foreach1


            // Return the array of users with the top users on the top
            function compareRatings($a, $b) {
                return $b["ratingCount"] - $a["ratingCount"];
            }

            // Return the array of users with the newest registered users on the top
            function sortByNewest($a, $b){
                $t1 = strtotime($a['date_of_reg']);
                $t2 = strtotime($b['date_of_reg']);

                return $t2 - $t1;
            }

            // Return the array of users with the oldest users on the top
            function sortByOldest($a, $b){
                $t1 = strtotime($a['date_of_reg']);
                $t2 = strtotime($b['date_of_reg']);

                return $t1 - $t2;
            }

            // Converting results from query from StdObject to array
            $dataResults = objectToArray($dataResults);

            // Determining which way to sort users
            switch($sortBy){
                case "top":
                    usort($dataResults, "compareRatings");
                break;

                case "newest":
                    usort($dataResults, "sortByNewest");
                break;

                case "oldest":
                    usort($dataResults, "sortByOldest");
                break;

                default:

                break;
            }

            if(isset($dataResults)){
                return $dataResults;
            }else{
                return false;
            }
        
        } 
    
    } // end of getAll



    // getTopUsers
    // Get a list of the 6 top users to be displayed on the decks page
    function getTopUsers(){

        $this->db->select('u.user_id, u.username, COUNT(r.rating_id) as ratingCount');
        $this->db->from('users as u');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->join('ratings as r', 'd.deck_id = r.deck_id');
        $this->db->group_by('u.user_id');
        $this->db->order_by('ratingCount', 'desc');
        $this->db->limit('6');

        $query = $this->db->get();

        if($query->num_rows > 0){
            foreach($query->result() as $row){
                $dataResults[] = $row;
            }

            $dataResults = objectToArray($dataResults);

            return $dataResults;
        }else{
            // No users found;
        }
    }


    // userSearch
    function userSearch($searchQuery){

        $this->db->select('u.user_id, u.username, u.date_of_reg, u.profile_img ,COUNT(r.rating_id) as ratingCount');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->join('ratings as r', 'd.deck_id = r.deck_id');
        $this->db->group_by('u.user_id');
        $this->db->order_by('ratingCount', 'desc');
        $this->db->like("u.username", $searchQuery['user']);
        $this->db->or_like('u.email', $searchQuery['user']);
        $query = $this->db->get("users as u");

        if($query->num_rows > 0){
            foreach($query->result() as $row){
                $dataResults[] = $row;
            }

            // echo '<pre>';
            // print_r($dataResults);
            // echo '</pre>';
            
            return $dataResults;
            
        }else{
            return false;
        }
    }



} // end of user class