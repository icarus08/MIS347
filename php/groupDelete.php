<?php
define('DB_NAME', 'skecomplaints');
define('DB_USER', 'ske');
define('DB_PASSWORD', 'ske');
define('DB_HOST', 'localhost');

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(! $conn)
{
	die('Could not connect');
}

$db_selected = mysql_select_db(DB_NAME, $conn);


	if(! $db_selected)
	{
		die('Cannot use ' . DB_NAME . ': ' . mysql_error());
	}

  $Group_Name = test_input($_POST['Group_Name'])
	$sql = 'SELECT Group_ID FROM groups WHERE Group_Name=$Group_Name';
	$retval = mysql_query( $sql, $conn );

   if(! $retval ) {
      die('Could not get data: ' . mysql_error());
   }


	$sql2 =  "DELETE FROM groups WHERE Group_ID=$retval";
	$retval2 = mysql_query($sql2, $conn);
	echo "DELETED <br>";
	echo "{$row[0]}";
	 mysql_free_result($retval);

	mysql_close($conn);

?>
