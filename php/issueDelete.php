<html>
<body>
<?php
define('DB_NAME', 'skecomplaints');
define('DB_USER', '');
define('DB_PASSWORD', '');
define('DB_HOST', '');
    $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,'skecomplaints'); 


      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

	$issueID = ($_POST['userid']);

      $sql = "DELETE FROM issues WHERE Issues_ID = '".$issueID."' ";  //1 for admin, 2 for ops, 3 for patron
		echo "$issueID";
		$result = $conn->query($sql);
      if($conn->query($sql)){
         echo "deleted";
      }
      else
        echo " Error: ";

      $conn->close();

?>
</body>
</html>
