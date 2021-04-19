<?php
include "../includes/connection.php";
// session_start();
    if(isset($_POST['register'])){

        $yourname =  $_POST["yourname"];
        $address =  $_POST["address"];
        $emailadd =  $_POST["emailadd"];
        $user_name =  $_POST["username"];
        $user_password =  $_POST["password"];
         $confirmpw = $_POST["confirmpw"];

        $user_type = 'user';
      
        $stmt = $conn->prepare('INSERT INTO user_tb (user_complete_name, user_address, user_email_add, user_username, user_password, user_type) VALUES(?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("ssssss", $yourname, $address, $emailadd, $user_name, $user_password,$user_type );
        $stmt->execute();
        if ($stmt==true) {

                 echo "<script>
                            alert('Succesfully Registered ');
                            window.location.href='../index.php';
                       </script>";
        }
        else{
            echo "<script>
                        alert('Failed to Post');
                 </script>";
        }
      
    }
    
?>