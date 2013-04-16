<?php
	
	$this->load->helper('form');
	$this->load->helper('html');
	$this->load->helper('url');

?>

<?php echo form_open("yourcards/processnewcard/".$deckID); ?>
	<h1>New Card</h1>

	<p>Question:</p>
	<?php echo form_input("question"); ?>
	
	<p>Answer:</p>
	<?php echo form_input("answer"); ?>
	
	<button type="submit">Submit</button>
<?php echo form_close(); ?>