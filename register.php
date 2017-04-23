<?php require_once('includes/template-top.php'); ?>


<div class="container2" style="display:block;" >
<?php include("includes/connection.php"); ?>
<?php include("includes/session.php"); ?>


		<?php 
     //check if user has logged in
	 if(isset($_SESSION['customerNames'])){
		 redirect_to("index.php");
		 
		 }//

?>
<?php
        
		  
		    //form login submitted
		   if(isset($_GET['login_btn'])){
			 
			  //form variables
			  $email = trim(mysql_prep($_GET['email']));
			  $password = md5($_GET['password']);
			  
			  //check whether email exist
			  $query = "SELECT * FROM tblmembers WHERE email = '$email' and password = '$password'  LIMIT 1";
			  $result = mysql_query($query, $connection) or die("Query failed : ".mysql_error());
			  $row = mysql_fetch_array($result);
			  if ($row > 0 ){  
			      //fetch
				  $query2 = "SELECT * FROM tblmembers WHERE email = '$email' and password = '$password'  LIMIT 1";
				  $result2 = mysql_query($query2, $connection) or die("Query failed : ".mysql_error());
				  while ($row2 = mysql_fetch_array($result2)) {
					  $session_usernames = $row2['username'];
					  $session_phone = $row2['phone'];
					  }
			   
			  //set session
			  $_SESSION['customerNames'] = $session_usernames;
		      $_SESSION['customerEmail'] = $email;
			  $_SESSION['customerPhone'] = $session_phone;
		  
		      //redirect
	          redirect_to("index.php");	
			  
			  }
			  else{
				  //invalid login
				  $error_login = 'Invalid Login';
				  
				  }
			  
			  }//
			  
			  
			  
			  
      //form add member submitted
	  if(isset($_POST['add_member'])){
		  $names = ucfirst(mysql_prep($_POST['names']));
		  $username = mysql_prep($_POST['username']);
		  $email = mysql_prep($_POST['email']);
		  $phone = mysql_prep($_POST['phone']);
		  $password = md5($_POST['password']);
		  
					  //form data
						$form_data = array(
					      'names' => $names,
						  'username' => $username,
						  'email' => $email,
						  'phone' => $phone,
						  'password' => $password				   
					   );
					   
					   //insert
					 dbRowInsert('tblmembers' , $form_data);
		   
		  			 redirect_to("register.php");
				   
				   
				           }
		   
		  



?>



<div class="#" style="display:inline;" >
<h2 style="color:white;"><span style="color:#f03;">Not a Member? &raquo; </span>  Register </h2>
 
  <div class="middle-row">
<!-- Validation javascripts -->
<script src="js/validate.js"></script>

 <form action="register.php" method="post" name="register_form" onSubmit="return alert('Register Successful. Please continue with login')" enctype="multipart/form-data">
   <label style="color:white;" >Your Names </label>
   <input class="u-full-width" type="text" name="names"  title="must not include a number" value="<?php  if(isset($_POST['names']))echo  $_POST['names']; ?>" required>
   
    <br>
  
    <label style="color:white;" >Username </label>
    <input class="u-full-width" type="text" name="username" value="<?php  if(isset($_POST['username']))echo  $_POST['username']; ?>" required>
   
    <br>
		      <label for="EmailInput">Email <span class="warning <?php if(!isset($error_email)) echo 'hide'; ?>"></span></label>
   <input class="u-full-width" type="email" name="email"   value="<?php if(isset($_POST['email'])) echo  $_POST['email'] ; ?>">
		 
	 </div>
	  <div class="middle-row">
	  
   <label style="color:white;" for="phoneInput"> Phone</label>
   <input class="u-full-width" name="phone" type="text"  value="<?php if(isset($_POST['phone'])) echo  $_POST['phone'] ; ?>" onKeyup="isNumeric()"   onblur="isNumeric(document.getElementById('phone'),'Invalid Phone number OR remove spaces!!');" id="phone">
   
   <br>
	 <label style="color:white;" for="Password">Password</label>
   <input class="u-full-width" name="password" type="password"  title="must contain atleast one uppercase, one lowercase, a number, and must be more that 8 characters"  >
   
     <br>

	 
   <label style="color:white;" for="Password">Confirm Password</label>
   <input class="u-full-width" name="cpassword" onBlur="return chkpass()" type="password"  >
    <br>

  
          
   
   <input class="button-primary" type="submit" name="add_member"  style="float: right;" value="Register ">
</form>
</div>



<div style="float:right;">
 <h2 style="color:white;"><span style="color:#f03;">Members &raquo; </span><strong>Login </strong></h2>
    <div class="middle-row1">
    
   <form action="register.php" method="get">
   <label style="color:white;" for="EmailInput">User Email <span class="warning <?php if(!isset($error_login)) echo 'hide'; ?>"></span></label>
   <input class="u-full-width" type="email" name="email" value="<?php if(isset($_GET['email'])) { echo  $_GET['email']; }?>" required>
   
 
   <label style="color:white;" for="Password">Password</label>
   <input class="u-full-width" name="password" type="password"  required>
   
   <br>
   <input class="button-primary" type="submit" name="login_btn" style="float: right;" value="Submit">
   </form>
    
    
	</div>


</div>
</div>
</div>
<?php require_once('includes/template-footer.php'); ?>.

				
		
	
	</body>
	</html>