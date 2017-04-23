<?php include("includes/connection.php"); ?>
<?php include("includes/session.php"); ?>
<?php require_once('includes/template-top.php'); ?>

<div class="container2" style="color:white; padding-top:45px;  font-size: 17px;" >
<?php 
     //check if user has logged in
	 if(!isset($_SESSION['customerNames'])){
		 redirect_to("index.php");
		 
		 }//
?>
<?php 
      //confirm user has logged in
	  Confirm_Cus_logged_in();
	  $session_username = $_SESSION['customerNames'];
	  $session_email = $_SESSION['customerEmail'];
	  $session_phone = $_SESSION['customerPhone'];
	  
?>
<?php
		  
      //form register ride submitted
	  if(isset($_POST['register_ride'])){
		  $origin = ucfirst(mysql_prep($_POST['origin']));
		  $destination = mysql_prep($_POST['destination']);
		  $capacity = mysql_prep($_POST['capacity']);
		  $date = mysql_prep($_POST['date']);
		  $usernames = $session_username;
		  
					  //form data
						$form_data = array(
					      'username' => $usernames,
						  'origin' => $origin,
						  'destination' => $destination,
						  'capacity' => $capacity,
						  'date' => $date
						  
					   );
					   
					   //insert
					 dbRowInsert('tblregisterride' , $form_data);
		   
		  			 redirect_to("availablerides.php");
				   
				   
				           }
		   
		  



?>



<div class="#" style="display:inline;" >
<h2 style="color:white;   font-size: 30px;"><span style="color:#f03;">Members </span> &raquo; Register Ride: </h2>
 
  <div class="middle-row" style="width: 400px;">
<!-- Validation javascripts -->
<script src="js/validate.js"></script>
<!-- Date and Time javascript-->
<script language="javascript" type="text/javascript" src="js/datetimepicker.js"> </script>

 <form action="registerride.php" method="post" name="register_form" onSubmit="return alert('Ride Successfully Registered')" enctype="multipart/form-data">
   <label style="color:white;" >Ride Origin </label>
   <input class="u-full-width" type="text" name="origin"  title="Where the ride begins " value="<?php  if(isset($_POST['origin']))echo  $_POST['origin']; ?>" required>
   
    <br>
  
    <label style="color:white;" >Ride Destination </label>
    <input class="u-full-width" type="text" name="destination" value="<?php  if(isset($_POST['destination']))echo  $_POST['destination']; ?>" required>
   
    <br>
	
	</div>
	  <div class="middle-row">
	  
   <label style="color:white;" > Space Available i.e No. of Seats </label>
   <input class="u-full-width" name="capacity" type="text"  value="<?php if(isset($_POST['capacity'])) echo  $_POST['capacity'] ; ?>" onKeyup="isNumeric()"   onblur="isNumeric(document.getElementById('phone'),'Invalid Phone number OR remove spaces!!');"  required>
   
   <br>
  <label style="color:white;" >Ride Date and Time </label>
  <input class="u-full-width" name="date" type="Text" id="demo1" placeholder="Please use calender on the right" style="width:90%" required><a href="javascript:NewCal('demo1','ddmmmyyyy',true,24)"><img src="images/cal.gif" width="30" height="30" border="0" alt="Pick a date"></a>
  <br>
          
   
   <input class="button-primary" type="submit" name="register_ride"  style="float: right;" value="Register Ride ">
</form>
</div>





</div>
				
	</div>	
	<?php require_once('includes/template-footer.php'); ?>.
	</body>
	</html>