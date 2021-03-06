<?

class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();

        $this->load->helper('objectToArray.php');
    }


    // getProfile 
    // Get all of users information and load their profile page
    function getProfile($userID){
        $this->db->select("u.user_id, u.username, u.date_of_reg, u.profile_img");
        $this->db->from('users as u');
        $this->db->where("u.user_id", $userID);          
        $q1 = $this->db->get();

    	if($q1->num_rows > 0){
    		foreach($q1->result() as $row){
    			$userInfo[] = $row;
    		}
    	}else{
    		// No Results Found
    		echo "No Results";
    	}

        $userInfo = objectToArray($userInfo);

        // Formatting registration date
        $dateOfReg = strtotime($userInfo[0]['date_of_reg']);
        $userInfo[0]['date_of_reg'] = date("M d, Y", $dateOfReg);


        $dataResults['userInfo'] = $userInfo[0];


        // Getting the total amount of decks
        $this->db->select('COUNT(d.deck_id) as deckCount');
        $this->db->from('users as u');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->where('u.user_id', $userID);
        $q2 = $this->db->get();

        if($q2->num_rows > 0){
            foreach($q2->result() as $row){
                $deckInfo[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['deckCount'] = objectToArray($deckInfo[0]->deckCount);

        // Getting the total amount of cards
        $this->db->select('COUNT(c.card_id) as cardsCount');
        $this->db->from('users as u');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->join('cards as c', 'd.deck_id = c.deck_id');
        $this->db->where('u.user_id', $userID);
        $q6 = $this->db->get();

        if($q6->num_rows > 0){
            foreach($q6->result() as $row){
                $cardCount[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['cardCount'] = objectToArray($cardCount[0]->cardsCount);


        // Getting the total amount of tags
        $this->db->select('COUNT(t.tag_id) as tagsCount');
        $this->db->from('users as u');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->join('tags as t', 'd.deck_id = t.deck_id');
        $this->db->where('u.user_id', $userID);
        $q3 = $this->db->get();

        if($q3->num_rows > 0){
            foreach($q3->result() as $row){
                $tagCount[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['tagCount'] = objectToArray($tagCount[0]->tagsCount);


        // Getting the total amount of ratings
        $this->db->select('COUNT(r.rating_id) as ratingsCount');
        $this->db->from('users as u');
        $this->db->join('decks as d', 'u.user_id = d.user_id');
        $this->db->join('ratings as r', 'd.deck_id = r.deck_id');
        $this->db->where('u.user_id', $userID);
        $q3 = $this->db->get();

         if($q3->num_rows > 0){
            foreach($q3->result() as $row){
                $ratingCount[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['ratingCount'] = objectToArray($ratingCount[0]->ratingsCount);


        // Getting the total amount of friends
        $this->db->select('COUNT(uf.friend_id) as friendsCount');
        $this->db->from('users as u');
        $this->db->join('user_friends as uf', 'u.user_id = uf.user_id');
        $this->db->where('u.user_id', $userID);
        $this->db->where('uf.active', 1);
        $this->db->or_where('uf.friend_id', $userID);
        $this->db->where('uf.active', 1);
        $q3 = $this->db->get();

         if($q3->num_rows > 0){
            foreach($q3->result() as $row){
                $friendCount[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['friendCount'] = objectToArray($friendCount[0]->friendsCount);


        $this->db->select('COUNT(ub.badge_id) as badgeCount');
        $this->db->from('users as u');
        $this->db->join('user_badges as ub', 'u.user_id = ub.user_id');
        $this->db->where('u.user_id', $userID);
        $q4 = $this->db->get();

         if($q4->num_rows > 0){
            foreach($q4->result() as $row){
                $badgeCount[] = $row;
            }
        }else{
            // No Results Found
            echo "No Results";
        }

        $dataResults['badgeCount'] = objectToArray($badgeCount[0]->badgeCount);

        $this->db->select('pv.count as profileViews');
        $this->db->from('users as u');
        $this->db->join('profile_views as pv', 'u.user_id = pv.user_id');
        $this->db->where('u.user_id', $userID);
        $q5 = $this->db->get();

         if($q5->num_rows > 0){
            foreach($q5->result() as $row){
                $profileViews[] = $row;
            }
        }else{
            $profileViews = 0;
        }

        if($profileViews == 0){
            $dataResults['profileViews'] = $profileViews;
        }else{
             $dataResults['profileViews'] = objectToArray($profileViews[0]->profileViews);
        }

        // echo '<pre>';
        // print_r($dataResults);
        // echo '</pre>';

    	if(isset($dataResults)){

    		return $dataResults;

    	}else{
    		return false;
    	}
    }


    // uploadImage
    // User can upload their own profile picture
    function uploadImage($data){ 
        $newProfileImage = array(
                            'profile_img' => $data['file_name']
        );

        $this->db->where('user_id', $data['raw_name']);
        $query = $this->db->update('users', $newProfileImage);

        if(!$query){
            return false;
        }else{
            return true;
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

                if($date2 < $date1){
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
                }else{
                    // User has viewed this profile in the past 24 hours,
                    // do not update profile count
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

        $this->db->select('u.user_id, u.username, u.date_of_reg, u.profile_img');
        $this->db->like("u.username", $searchQuery['user']);
        $this->db->or_like('u.email', $searchQuery['user']);
        $this->db->group_by('u.user_id');
        $query = $this->db->get("users as u");

        if($query->num_rows > 0){
            foreach($query->result() as $row){
                // $dataResults['userInfo'] = $row;
                 
                // var_dump($row->user_id);
                
                $this->db->select('u.user_id, u.username, u.profile_img, COUNT(r.rating_id) as ratingCount');
                $this->db->join('decks as d', 'u.user_id = d.user_id');
                $this->db->join('ratings as r', 'd.deck_id = r.deck_id');
                $this->db->where('u.user_id', $row->user_id);

                $q = $this->db->get('users as u');

                if(!$q->num_rows() == 0){
                    foreach($q->result() as $r){
                        $dataResults[] = $r;
                    }
                }else{
                    $dataResults = false;
                }
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