<?php
	$username = $this->session->userdata("username");

	function objectToArray($a){
		if(is_object($a)){
			$a = get_object_vars($a);
			return $a;
		}if(is_array($a)){
			return array_map(__FUNCTION__, $a);
		}else{
			return $a;
		}
	} ?>

<div id="content">
    <section id="topWelcome">
        <div class="sizer">
            <h1> Welcome, <?php echo $username; ?> </h1> 
               
	<? 
	//var_dump($userInfo);
	//var_dump($decks);
	
		if(!$decks){
			// User hasn't added any decks yet
			$u = objectToArray($userInfo);
			
			if(!$u[0]["profile_img"]){ ?> 
            	<p><img class="profilePicture" src="" alt="User Profile Picture"/></p> 
			<? }else{
					// Adjusting the string to add "_thumb" to the filename so it will only produce the thumbnail of the user
					$imgPath = $u[0]["profile_img"];
					$arrPath = explode(".", $imgPath);
					$profilePath = $arrPath[0]."_thumb.".$arrPath[1];
					echo img("uploads/thumbs/".$profilePath);
			} ?>
		
			<?php echo form_open_multipart("user/do_upload"); ?>
                
            <label class="filebutton">
                Change Image
                <span><input id="uploadButton"type="file" name="userfile" size="20" /></span>
            </label>
            <label class="filebutton" style="display: none;">
                Upload Image
                <span><input id="uploadSubmit" type="submit" value="upload" /></span>
            </label>

            </form>	
            
            <h3 id="createDeckButton"><?php echo anchor("user/createdecks", "Create Deck", "Create New Deck"); ?></h3>
        </div>
    </section>
    
    <section id="yourdecks">
            <div class="sizer">
            	<section id="first">
             		<div class="first_deck">
                        <h1>Please Add Your First Deck</h1>
                    </div>
               	</section>
            </div>
        </section>
    </div>
        
	<? }else{
        $a = objectToArray($decks);
        
        // Checking if the uses has uploaded a profile image yet, if they haven't upload the generic user profile picture
        if(!$a[0]["profile_img"]){ ?> 
        	<p><img class="profilePicture" src="" alt="User Profile Picture"/></p> <?
                }else{
                    // Adjusting the string to add "_thumb" to the filename so it will only produce the thumbnail of the user
                    $imgPath = $a[0]["profile_img"];
                    $arrPath = explode(".", $imgPath);
                    $profilePath = $arrPath[0]."_thumb.".$arrPath[1];
                    echo img("uploads/thumbs/".$profilePath);
                } ?>
                
               <?php echo form_open_multipart("user/do_upload"); ?>
               
                <label class="filebutton">
                    Change Image
                    <span><input id="uploadButton"type="file" name="userfile" size="20" /></span>
                </label>
                <label class="filebutton" style="display: none;">
                    Upload Image
                    <span><input id="uploadSubmit" type="submit" value="upload" /></span>
                </label>
                                
                </form>	
                
                <h3 id="createDeckButton"><?php echo anchor("user/createdecks", "Create Deck", "Create New Deck"); ?></h3>
            </div>
        </section>
    
        <section id="yourdecks">
            <div class="sizer">
    
                <?php foreach($a as $v){ ?>
                    <article class="deck">
                        <p class="edit"  data-deckid="<? echo $v["deck_id"] ?>">Edit</p>
                        <h1 class="privacy"><? if($v["privacy"]==0){?>Public<? }else{ ?>Private<? } ?></h1>
    
                        <h1 class="votes">143</h1>
                        <h1 class="deckname"><?php echo anchor("yourcards/getcards/{$v["deck_id"]}", $v["title"] , "View cards for this deck"); ?></h1>
                        <div class="deckDelete"></div>
                    </article>
                <?php } ?>
    
            </div>
        </section>
    
    <? } ?>