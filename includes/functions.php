  
<?php
function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" );
		if( $new_enough_php ) { 
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { 
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			
		}
		return $value;
	}
	
	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}
	
	
	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}
	

	
	
	
	
//DATABASE FUNCTIONS
	
	function dbRowInsert($table_name, $form_data)
    {
    $fields = array_keys($form_data);
	
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";

    
    return mysql_query($sql);

  }

 
    
function dbRowSelect($table_name, $where_clause='')
{
    
    $whereSQL = '';
    if(!empty($where_clause))
    {
       
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    
    $sql = "SELECT * FROM ".$table_name.$whereSQL;

    
    return mysql_query($sql);
}



function dbRowDelete($table_name, $where_clause='')
{
    
    $whereSQL = '';
    if(!empty($where_clause))
    {
        
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
          
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    
    $sql = "DELETE FROM ".$table_name.$whereSQL;

    
    return mysql_query($sql);
}
	
	
	
function dbRowUpdate($table_name, $form_data, $where_clause='')
{
    
    $whereSQL = '';
    if(!empty($where_clause))
    {
       
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
   
    $sql = "UPDATE ".$table_name." SET ";

   
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    
    $sql .= $whereSQL;

    
    return mysql_query($sql);
}
	
	
	
 
	 function getmonth($date){
	$newdate = date("M", strtotime($date));
	return $newdate;
	}
	
	
	function getday($date){
$newdate = date("d", strtotime($date));
return $newdate;
}

	
	function getmonthdate($date){
$newdate = date("M-d", strtotime($date));
return $newdate;
}
 
	
	function gen_uuid($len=8) {

    $hex = md5("yourSaltHere" . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp =  base64_encode($pack);

    $uid = preg_replace("#(*UTF8)[^A-Za-z0-9]#", "", $tmp);

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= gen_uuid(22);

    return substr($uid, 0, $len);
}
	
	
	?>