<?php
include "../includes/connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
if(isset($_POST['cancel'])){
  $bookid = $_POST['idid'];

  $stmtt = $conn->prepare('DELETE from booking_tb where booking_id=?');
  $stmtt->bind_param("s",$bookid);
  $stmtt->execute();
  header("location:../userBooking.php");
 }
                
  
?>