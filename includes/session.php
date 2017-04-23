<?php require_once("functions.php"); ?>
<?php
	session_start();
	
	
	/**MEMBER/CUSTOMER SESSION **/
		function Cus_logged_in() {
		return isset($_SESSION['customerNames']);
		return isset($_SESSION['customerEmail']);
		return isset($_SESSION['phone']);
		 
	 
	}
	
	function Confirm_Cus_logged_in(){
		if (!Cus_logged_in()) {
			redirect_to("register.php");
		}
	}
	
	


    
	 
	 
	 
?>