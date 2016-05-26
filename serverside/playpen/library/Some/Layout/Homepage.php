<?php

//
class Some_Layout_Homepage extends Some_Layout
{
	
	//
	public function echoTitle() {
		?>
		<title>Some</title>
		<?php	
	}
	
	//
	public function echoMain() {
		
		?>
		<html>
			<?php echo $this->getTitle(); ?>
		</html>
		<?php
	}

}



