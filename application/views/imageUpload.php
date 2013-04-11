<?php

	$att = array("id" => "imageUploader");

	echo form_open_multipart("yourcards/do_upload", $att);?>
	
	<input type="file" name="userfile" size="20" />
	<input type="submit" value="upload" />
	
	</form>	