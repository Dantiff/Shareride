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
       //check if ride to be booked has been selected
	   if(isset($_GET['bookID'])){
         $selectedID = $_GET['bookID'];		   
		   
		   
			        //get booking details
			        $query = "SELECT * from tblmembers, tblregisterride WHERE tblmembers.username = '$session_username' AND tblregisterride.ride_ID  = '$selectedID'";
				    $result = mysql_query($query, $connection);
					confirm_query($result);
					
					while($row=mysql_fetch_array($result)){
						$username = $row['username'];
						$names = $row['names'];
						$email = $row['email'];
						$phone = $row['phone'];
						$ride_ID = $row['ride_ID'];
						$origin = $row['origin'];
						$destination = $row['destination'];
						$capacity = $row['capacity'];
						$date = $row['date'];
						
						
						//form data
						$form_data = array(
					      
						  'names' => $names,
						  'email' => $email,
						  'phone' => $phone,
						  'username' => $username,
						  'ride_ID' => $ride_ID
					   
					   );
			   //insert into table
			   dbRowInsert('tblbookings' , $form_data);					   
					}

			   
			   //redirect
			   redirect_to('availablerides.php');
			}//
			

			   



?>


<div class="#" style="display:inline;" >
<h2 style="color:white;   font-size: 30px;"><span style="color:#f03;">Available </span> Rides &raquo;   </h2>
 
<div class="middle-row" style="width: 850px;">

  <form action="availablerides.php" method="get">
    <div class="row" style="display:inline;">
      <input class="u-full-width " type="search" placeholder="Search ride by origin, destination, capacity, or driver" style="width:60%;" name="s" required>
      <input class="button-primary " type="submit" value="Search Rides">
      <a href="availablerides.php" class="button-primary " style="color:white;   font-size: 20px;">View All</a>

    </div>
  </form>

 <div id="print">
 
 <table class="u-full-width">
  <thead>
    <tr>
      <th>#</th>
      <th>Ride Driver</th>
      <th>Ride Origin</th>
      <th>Ride Destination</th>
      <th>Ride Capacity</th>
      <th>Ride Date</th>
	  <th>Book Ride</th>
      
    </tr>
  </thead>
  <tbody>

        <?php
		
		if(isset($_GET['s'])){ // search ride
			$search = trim(mysql_prep($_GET['s']));
			$query = "SELECT * from view_rides  and (date LIKE '%$search%' or names LIKE '%$search%' or origin LIKE '%$search%' or destination LIKE '%$search%' )  ";
			
			}
			else{
		$query="SELECT * from view_rides order by date asc ";
		
			}
		$result = mysql_query($query, $connection) or die("Query failed : ".mysql_error());
		$count = 1;
		
		while($row = mysql_fetch_array($result)){
			$username = $row['names'];
			$origin = $row['origin'];
			$destination = $row['destination'];
			$capacity = $row['capacity'];
			$date = $row['date'];
		
		?>
    <tr>
        <td><?php echo $count;?></td>
        <td><?php echo $username;?></td>
        <td><?php echo $origin;?></td>
        <td><?php echo $destination;?></td>
        <td><?php echo $capacity;?></td>
		<td><?php echo $date;?></td>
		<td > <strong> <a  href="availablerides.php?bookID=<?php echo $row['ride_ID']; ?>" onclick="return alert('Ride Successfully Booked. Please check your email for confirmation.')" style="color:blue; text-decoration:none; font-style:italicize;" >Book Ride &raquo;</a> </strong></td>


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