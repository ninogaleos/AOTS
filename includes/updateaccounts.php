<?php
include "../includes/connection.php";
    if(isset($_POST['updateacct'])){
        echo "ok";
        $user_id = $_POST['user_id'];
        $completename = $_POST['completename'];
        $address = $_POST['address'];
        $emailadd = $_POST['emailadd'];
        $user_username = $_POST['user_username'];
        $password = $_POST['password'];

        $query = $conn->prepare("UPDATE user_tb SET user_complete_name=?, user_address=?, user_email_add=?, user_username=?, user_password=? WHERE user_id=?");
        $query->bind_param('sssssi', $completename, $address, $emailadd, $user_username, $password, $user_id );
        $query->execute();
        if ($query==true) {
            echo "<script>
            alert('Successfully Updated');
            window.location.href='../useraccount.php';
       </script>";
      }else{
          echo 'failed';
      }
   
    }
    
?>