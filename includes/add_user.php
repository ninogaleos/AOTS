<?php
include "../includes/connection.php";
// session_start();
    if(isset($_POST['adduser'])){

        $completename = $_POST['completename'];
        $user_address = $_POST['user_address'];
        $emailAddress = $_POST['emailAddress'];
        $user_username = $_POST['user_username'];
        $user_password = $_POST['user_password'];
        $user_type = $_POST['user_type'];

      
        $stmt = $conn->prepare('INSERT INTO user_tb (user_complete_name, user_address, user_email_add, user_username, user_password, user_type) VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("ssssss", $completename, $user_address, $emailAddress, $user_username, $user_password, $user_type);
        $stmt->execute();
        if ($stmt==true) {
            
             header("location:../adminadduser.php");
        }
        else{
            echo "<script>
                        alert('Failed to Post');
                 </script>";
        }
      
    }
   
?>