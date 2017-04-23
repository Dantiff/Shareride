<?php include("includes/connection.php"); ?>
<?php include("includes/session.php"); ?>
<?php require_once('includes/template-top.php'); ?>

<div class="container2" style="color:white; padding-top:45px;  font-size: 17px;" >

<?php 
      //confirm user has logged in
	  Confirm_Cus_logged_in();
	  $session_username = $_SESSION['customerNames'];
	  $session_email = $_SESSION['customerEmail'];
	  $session_phone = $_SESSION['customerPhone'];
	  
?>
<?php 
       //check if ride to be given has been selected
	   if(isset($_GET['rideID'])){
         $selectedID = $_GET['rideID'];		   
		   

			        //get booking details
			        $query = "SELECT * from tblbookings, tblregisterride WHERE tblbookings.ride_ID = tblregisterride.ride_ID AND tblregisterride.ride_ID = '$selectedID'";
				    $result = mysql_query($query, $connection);
					confirm_query($result);
					
					while($row=mysql_fetch_array($result)){
						
						$names = $row['names'];
						$email = $row['email'];
						$phone = $row['phone'];
						$ride_ID = $row['ride_ID'];
						$origin = $row['origin'];
						$destination = $row['destination'];
						$capacity = $row['capacity'];
						$date = $row['date'];
						
			
			
require 'class.phpmailer.php' ;
require 'class.smtp.php' ;
require 'PHPMailerAutoload.php' ;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp' ;
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com' ; 
$mail->Port = 465 ;
$mail->SMTPSecure = 'ssl' ;

$mail->Port = 587;
$mail->SMTPSecure = 'tls';


$mail->Username = "service.helpdesk2016@gmail.com" ;
$mail->Password = "helpdesk2016" ;
$mail->IsHTML( true); 
$mail->SingleTo = true; 

$mail->From = "service.helpdesk2016@gmail.com" ;
$mail->FromName = "$session_username" ;
$mail->addAddress ( $email ,"Ride Requester" );

$mail->Subject = "Ride Request from $origin to $destination" ;

$mail->Body = "Hi, <br /> 
 This is to confirm that your ride request from $origin to $destination on $date have been accepted. <br />
 For further communication, please contact me at $session_email or via my cell at $session_phone. <br />
 With regards, <br />
 $session_username." ;
if(!$mail->Send()){
echo "Message was not sent <br/>PHPMailer Error: " . $mail->ErrorInfo;

		}
else{

		       //Remove the original booking
			   dbRowDelete('tblregisterride', " WHERE ride_ID = '$ride_ID'");
			   dbRowDelete('tblbookings', " WHERE ride_ID = '$ride_ID'");
			   
			   
}
 
	   } 
	  			   
			   
			   
			   
			   
			   //redirect
			   redirect_to('giveride.php');
			   
			  
			  }//
		   
		   
		   
?>


<div class="#" style="display:inline;" >
<h2 style="color:white;   font-size: 30px;"><span style="color:#f03;">Ride requests </span> to you &raquo;   </h2>
 
<div class="middle-row" style="width: 850px;">

  <form action="giveride.php" method="get">
    <div class="row" style="display:inline;">
      <input class="u-full-width " type="search" placeholder="Search ride by origin, destination, capacity, or driver" style="width:60%;" name="s" required>
      <input class="button-primary " type="submit" value="Search Rides">
      <a href="giveride.php" class="button-primary " style="color:white;   font-size: 20px;">View All</a>

    </div>
  </form>

 <div id="print">
 
 <table class="u-full-width">
  <thead>
    <tr>
      <th>#</th>
      <th> Requester Name</th>
      <th>Requester Email</th>
      <th>Requester Phone</th>
      <th>Ride Origin</th>
	  <th>Ride Destination</th>
      <th>Ride Date</th>
	  <th>Give Ride</th>
      
    </tr>
  </thead>
  <tbody>

        <?php
		
		if(isset($_GET['s'])){ // search ride
			$search = trim(mysql_prep($_GET['s']));
			$query = "SELECT * from tblmembers, tblregisterride, tblbookings WHERE tblmembers.username= '$session_username' AND tblmembers.username=tblregisterride.username AND tblregisterride.ride_ID=tblbookings.ride_ID and (date LIKE '%$search%' or names LIKE '%$search%' or origin LIKE '%$search%' or destination LIKE '%$search%' )  ";
			
			}
			else{
		$query="SELECT * from tblmembers, tblregisterride, tblbookings WHERE tblmembers.username= '$session_username' AND tblmembers.username=tblregisterride.username AND tblregisterride.ride_ID=tblbookings.ride_ID order by date asc ";
		
			}
		$result = mysql_query($query, $connection) or die("Query failed : ".mysql_error());
		$count = 1;
		
		while($row = mysql_fetch_array($result)){
			$username = $row['username'];
			$email = $row['email'];
			$phone = $row['phone'];
			$origin = $row['origin'];
			$destination = $row['destination'];
			$date = $row['date'];
		
		?>
    <tr>
        <td><?php echo $count;?></td>
        <td><?php echo $username;?></td>
        <td><?php echo $email;?></td>
        <td><?php echo $phone;?></td>
        <td><?php echo $origin;?></td>
        <td><?php echo $destination;?></td>
		<td><?php echo $date;?></td>
		<td > <strong> <a  href="giveride.php?rideID=<?php echo $row['ride_ID']; ?>" onclick="return alert('Ride Successfully given. System will automatically email ride requester for confirmation')" style="color:blue; text-decoration:none; font-style:italicize;" >Give Ride &raquo;</a> </strong></td>

 <?php 
       //check if ride to be given has been selected
	   if(isset($_GET['rideID'])){
         $selectedID = $_GET['rideID'];		   
		   

			        //get booking details
			        $query = "SELECT * from tblbookings, tblregisterride WHERE tblbookings.ride_ID = tblregisterride.ride_ID AND tblregisterride.ride_ID = '$selectedID'";
				    $result = mysql_query($query, $connection);
					confirm_query($result);
					
					while($row=mysql_fetch_array($result)){
						
						$names = $row['names'];
						$email = $row['email'];
						$phone = $row['phone'];
						$ride_ID = $row['ride_ID'];
						$origin = $row['origin'];
						$destination = $row['destination'];
						$capacity = $row['capacity'];
						$date = $row['date'];
						
			
			
require 'class.phpmailer.php' ;
require 'class.smtp.php' ;
require 'PHPMailerAutoload.php' ;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp' ;
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com' ; 
$mail->Port = 465 ;
$mail->SMTPSecure = 'ssl' ;

$mail->Port = 587;
$mail->SMTPSecure = 'tls';


$mail->Username = "service.helpdesk2016@gmail.com" ;
$mail->Password = "helpdesk2016" ;
$mail->IsHTML( true); 
$mail->SingleTo = true; 

$mail->From = "service.helpdesk2016@gmail.com" ;
$mail->FromName = "$session_username" ;
$mail->addAddress ( $email ,"Ride Requester" );

$mail->Subject = "Ride Request from $origin to $destination" ;

$mail->Body = "Hi, <br /> 
 This is to confirm that your ride request from $origin to $destination on $date has been accepted. <br />
 For further communication, please contact me at $session_email or via my cell at $session_phone. <br />
 With regards, <br />
 $session_username." ;
if(!$mail->Send()){
echo "Message was not sent <br/>PHPMailer Error: " . $mail->ErrorInfo;

		}
else{

		       //Remove the original booking
			   dbRowDelete('tblregisterride', " WHERE ride_ID = '$ride_ID'");
			   dbRowDelete('tblbookings', " WHERE ride_ID = '$ride_ID'");
			   
			   
}
 
	   } 
	  			   
			   
			   
			   
			   
			   //redirect
			   redirect_to('giveride.php');
			   
			  
			  }//
		   
		   
		   
?>

 
 
    </tr>
    
     <?php 
	 $count++;
	 } ?>
     
  </tbody>
</table>

 </div>




</div>
</div>
				
	</div>	
	<?php require_once('includes/template-footer.php'); ?>.
	</body>
	</html>