<?php
    include "includes/connection.php";
    session_start();
    if(!isset($_SESSION["loggedin"])){
        header('Location: index.php');
        exit;
    }
    ?>
<!doctype HTML>
<html lang="en">
<title>Angasil Online Ticket System</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/w3.css">
<style>
    @media print{
        #printPageButton{
            display:none;
        }
        #cancelbtn{
            display: none;
        }
    }
</style>
<?php
        
?>
 <div class="w3-container w3-right">
 <form method="POST">
 <button id="printPageButton" class="w3-button w3-green" onClick="window.print();">Print</button>
 <button id="cancelbtn" class="w3-button w3-red" name=""><a href="adminPassengerlist.php">Cancel </a></button>
</div>
    <head>
    <div class="w3-container w3-center">
        <h2>ANGASIL TICKETING</h1>
        <h3>Lapu-Lapu City</h3>
    </div>
       
</head>  

<body>
<br><br>
 
    <div class="w3-container">
        <table class="w3-table w3-hoverable">
                <tr>
                    <th>Boat Name</th>
                    <th>Destination</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Passenger Name</th>
                    <th>Type</th>
                    <th>Ticket Number</th>
                    <th>Status</th>
                    
                </tr>
        <?php
            if(isset($_POST['search'])) {
                $from = $_POST['from'];
                $to = $_POST['to'];
               
                echo $from, $to;
             
        ?>
            <div class="w3-container">
                   <?php
                        $sqls = "SELECT * FROM passenger_tb WHERE BoatDate Between ? and ? ";
                        $stmts = $conn->prepare($sqls); 
                        $stmts->bind_param("ss", $from, $to);
                        $stmts->execute();
                        $results = $stmts->get_result();
                       
                        while ($row = $results->fetch_assoc()) {

                            ?>
                           
                            <tr>
                                <td><?php echo $row['Boat_name']?></td>
                                <td><?php echo $row['BoatDestination']?></td>
                                <td><?php echo $row['BoatTime']?></td>
                                <td><?php echo $row['BoatDate']?></td>
                                <td><?php echo $row['Passenger_name']?></td>
                                <td><?php echo $row['Passenger_type']?></td>
                                <td><?php echo $row['ticket_number']?></td>
                                <td><?php 
                                    if($row['Passenger_stat']==1){
                                            echo "Used";
                                    }else if($row['Passenger_stat']==3){
                                        echo"Used";
                                    }else{
                                        echo "not use";
                                    }
                                ?></td>
                              
                            </tr>
                       <?php }
                    }
                   ?>
            </div>
            <br>
        </table>
    <br><br>
    </div>        
</body>
<footer class="w3-footer">
            <?php
                    echo php_uname();
            ?>
</footer>
<script>
   function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>
</html>