<?php
include "../includes/connection.php";
session_start();
if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
    if(isset($_POST['addbook'])){

            $reference = $_POST['reference'];
            $user_id = $_SESSION['id'];
            $sql= "SELECT * FROM ticket_cart where user_id=$user_id";
            $stmts = $conn->prepare($sql);
            $stmts->execute();
            $resultSets = $stmts->get_result();
            $results = $resultSets->fetch_all();
            foreach($results as $row){
              

                echo $row['1'];

                        $stmt = $conn->prepare('INSERT INTO ticket_book ( book_user_id, book_user_name, book_reference_number, book_ticket_type, book_ticket_number, book_ticket_price, book_ticket_attachment, book_status) 
                                                VALUES(?, ?, ?, ?, ?, ?, ?, 1)');
                        $stmt->bind_param("sssssss", $row['5'], $row['6'], $reference, $row['2'], $row['1'], $row['3'], $row['7']  );
                        $stmt->execute();
                         if ($stmt==true) {
                            $user_ids = $_SESSION['id'];
                            $stmt = $conn->prepare('DELETE from ticket_cart where user_id=?');
                            $stmt->bind_param("s",$user_ids);
                            $stmt->execute();

                            $stmts = $conn->prepare('INSERT INTO message_tb(user_id, msg_stat) values (?, 1)');
                            $stmts->bind_param("s",$user_ids);
                            $stmts->execute();
                         header("location:../user_home.php");
                     }
                    else{
                        echo "<script>
                                    alert('Failed to add to cart');
                             </script>";
                    }
                     }

      

        }
        if(isset($_POST['delete'])){

            $idss = $_POST['id'];
           $stmtt = $conn->prepare('DELETE from ticket_cart where ticket_id=?');
              $stmtt->bind_param("s",$idss);
              $stmtt->execute();
              header("location:../user_home.php");
          }
       
?>