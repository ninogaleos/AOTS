<?php
include "../includes/connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
    if(isset($_POST['Book'])){ 
        $imgFile = $_FILES['attachment-pic']['name'];
        $tmp_dir = $_FILES['attachment-pic']['tmp_name'];
        $imgSize = $_FILES['attachment-pic']['size'];
       $user_id = $_SESSION['id'];
       $name = $_SESSION['completename'];
if(empty($imgFile)){
   $errMSG = "Please Select Image File.";
   }else
   {

           $upload_dir = '../uploads/'; 
   
           $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
       
           $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
       
           $userpic = rand(1000,1000000).".".$imgExt;
           
           if(in_array($imgExt, $valid_extensions)){   
       
           if($imgSize < 5000000)    {
           move_uploaded_file($tmp_dir,$upload_dir.$userpic);
           }
           else{
           $errMSG = "Sorry, your file is too large.";
           }
           }
           else{
           $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
           }
    }
   if(!isset($errMSG))
   {
            $username = $_SESSION['completename'];
            $user_id = $_SESSION['id'];
            $dates = $_POST['bookDate'];
            $boat_name = $_POST['boatname'];
            
            if($_POST['type']==30){
                $types="Regular";
            }else if($_POST['type']==25)
            {
                $types = "Student";
            }else if($_POST['type']==20){
                $types = "PWD / Senior Citizen";
            }else{
                echo "<script>
                alert('Error Booking Choose Type');
                window.location.href='../userHome.php';
           </script>";
            }
            $type = $types;
            $prices = $_POST['prices'];
            $tckt_name = $_POST['tckt_name'];
      
            $reference = $_POST['reference'];
            echo $boat_name;
            $imgFile = $_FILES['attachment-pic']['name'];
             $tmp_dir = $_FILES['attachment-pic']['tmp_name'];
             $imgSize = $_FILES['attachment-pic']['size'];


                        $stmt = $conn->prepare('INSERT INTO booking_tb (Booking_date, Boat_ID, Booking_type, Booking_price, Booking_tckt_name, Booking_attachment, Booking_reference, user_book_id, user_name, bookingdate, book_status) 
                                                VALUES(?, ?, ?, ?, ?, ?, ?, ?,?, now(), 1)');
                        $stmt->bind_param("sssssssss",$dates, $boat_name, $type, $prices, $tckt_name, $userpic, $reference, $user_id, $username );
                        $stmt->execute();
                         if ($stmt==true) {
                         
                            echo "<script>
                            alert('Succesfully Book');
                            window.location.href='../userHome.php';
                       </script>";

                     }
                    else{
                        echo "<script>
                                    alert('Failed to add ');
                             </script>";
                    }
                }   
        }
      
       
?>