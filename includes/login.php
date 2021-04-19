<?php
session_start();
include "../includes/connection.php";
    if(isset($_POST['login'])){
        $user_name =  $_POST["username"];
        $user_password = $_POST["password"];
        if ($user_name == '' || $user_password== '') {
            $msg = "please fill up form";
        } else {
    if ($stmt = $conn->prepare('SELECT user_id, user_complete_name, user_password, user_type FROM user_tb WHERE user_username = ? and user_password=?')) {
    
        $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $user_complete_name, $user_password, $user_type);
             $stmt->fetch();
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['completename'] = $user_complete_name;
            $_SESSION['type'] = $user_type;

            if($_SESSION['type'] == 'admin'){
                header('location: ../adminPassenger.php');
            }else if($_SESSION['type'] == 'superadmin'){
                header('location: ../adminHome.php');
            }else if ($_SESSION['type'] == 'user'){
                header('location: ../userHome.php');
            }
                           
        } else {  
            echo "<script>
                        alert('Incorect Username / Password');
                        window.location.replace('../index.php');
                 </script>";
                 
        }
    
        $stmt->close();
    }
    
        }
    }
?>