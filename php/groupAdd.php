<?php
       session_start();
       // Create connection
       $conn = new mysqli('localhost','ske','ske','skecomplaints'); // $config['username'], $config['password'],

       // Check connection
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }


       echo "Connected successfully";

       //get post field
       $Group_Name = test_input($_POST['Group_Name']);

       $Events = test_input($_POST['Event_ID']);
       $Groups = test_input($_POST['Group_ID']);

      //  $sqlUserFetch = "SELECT userID FROM users WHERE name";

       $session = $_SESSION['sessionUserID'];
         $sql = "INSERT INTO groups (Group_Name,Event_ID,User_ID)
       VALUES('$Group_Name', '$Events', '$Groups')";

       if($conn->query($sql) === TRUE){
         echo "Value Inserted successfully";
         //Indicate that the person has been registered
         header('Location: userAdd_admin.php');
       }
       else
         echo " Error: " . $sql . "<br>" . $conn->error;
       $conn->close();


       //To prevent sqlInjectio4n
       function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
       }
?>
