<?php
include "includes/connection.php";
 session_start();
 if(!isset($_SESSION["loggedin"])){
    header('Location: index.php');
    exit;
  }
?>
<!doctype HTML>
<html lang='en'>
    <title>Angasil Online Ticket System</title>
    <head>
      <style>
          @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
      </style>
    </head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <!-- <link rel="stylesheet" href="css/js/jquery.min.js">
    <link rel="stylesheet" href="css/js/bootstrap.min.css">
    <script src="css/js/jquery.min1.js"></script>
    <script src="css/js/bootstrap.min.js"></script> -->
    <script src="css/js/jquery.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="css/js/bootstrap.min.js"></script>
    
  <body>
  <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;">
    <div class="w3-container w3-teal">
    <br><br>
    <img src="icons/avatar.png" alt="Avatar" class="w3-left w3-circle w3-margin-right">
    <p><?php echo $_SESSION['completename'];?></p>
    <a class="w3-text-white" href="includes/logout.php">Logout</a>
      <hr>
    </div>
    <div class="w3-center w3-large w3-green">
            <button class="w3-btn"><a href="index.php">Back to Website</a></button>
        </div>
    <div class="w3-container">
     <h3 class="w3-bar-item">Menu</h3>
    <a href="userHome.php" class="w3-bar-item w3-button">Book Ticket</a>
    <a href="userBooking.php" class="w3-bar-item w3-button">My Booking</a>
    <a href="useraccount.php" class="w3-bar-item w3-button">My Account</a>
    </div>
  
</div>
    <div style="margin-left:20%" class="w3-container w3-teal">
    <h1>My Booking Ticket</h1>
</div>
<div class="w3-container" style="margin-left:20%;">
<br><br>

  <div class="w3-container">
  <form action="includes/printticket.php" method="POST">
        <table  width="100%" class="w3-table-all w3-hoverable">
		<thead>
		<th>Reference Number</th>
	  <th>Booking Date</th>
      <th>Passenger Name</th>
      <th>Type</th>
      <th>Price</th>
      <th style="display:none;">Messages</th>
      <th>Attachment</th>
      <th  style="display:none;">booking id</th>
      <th>Action</th>
		</thead>
		<tbody>
        <?php
       $id = $_SESSION['id'];
       $sql = "SELECT * FROM booking_tb WHERE user_book_id=?";
       $stmt = $conn->prepare($sql); 
       $stmt->bind_param("i", $id);
       $stmt->execute();
       $result = $stmt->get_result();
      
       while ($row = $result->fetch_assoc()) {
            ?> 
           
            <tr>
            <td><span id="reference<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_reference']; ?></span></td>
            <td><span id="bookingdate<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_date']; ?></span></td>
            <td><span id="tcktname<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_tckt_name']; ?></span></td>
            <td><span id="bookingtype<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_type']; ?></span></td>
            <td><span id="bookingprice<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_price']; ?></span></td>
            <td  style="display:none;"><span id="messages<?php echo $row['booking_id']; ?>"><?php echo $row['booking_messages']; ?></span></td>
            <td  style="display:none;"><span id="attach<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_attachment']; ?></span></td>
            <td>
              <span id="attach<?php echo $row['booking_id']; ?>"><?php echo $row['booking_id']; ?></span>

            </td>
            <td>
              
                <?php
                    if($row['book_status']== 1)
                    {
                      echo " <button type='button' class='btn btn-danger edit' value='".$row['booking_id']."'><span class='glyphicon glyphicon-trash'></span> Cancel</button>";
                    }else if($row['book_status']== 2){
                    ?>
                          <form action="includes/printticket.php" method="POST">
                            <input type="hidden" value="<?php echo $row['booking_id'];?>" name="bookingid">
                            <button class='btn btn-primary' name="print"><span class='glyphicon glyphicon-print'> </span> Print</button>
                          </form>
                     
                      <?php
                    }
                    else{
                      echo " <button type='button' class='btn btn-danger dissapproved' value='".$row['booking_id']."'><span class='glyphicon '></span>Dissapproved</button>";
                       
                    }
                ?>
             
            </td>
            </tr>
              <?php
          }
			
        ?>		
        </tbody>
      </table>      
   </form>
             <br><br> 
  </div>
  
</div> 


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
        
            <div class="modal-content">
                <div class="modal-header w3-red">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Cancel Booking</h4></center>
                </div>   
              
                <div class="modal-body"> 
                 <form method="POST" action="includes/delete.php" name="updateform" id="updateform">
             
                      <div class="container-fluid">
                            <div class="form-group input-group">
                               
                                 <input type="hidden" style="width:400px;" class="form-control" id="eid" name="idid" >
                            </div>	
                            <div class="container-fluid">
                               <p><h2 class=""> Are you sure to cancel your booking?</h2>
                             </p>
                            </div>
                           
                      </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                    <button type="submit" id="cancel" name="cancel" class="btn btn-success"  ><span class="glyphicon glyphicon-edit"></span> </i> Yes</button>
                </div>
                </form>
               
                
                </div>
        </div>
        
    </div>
 </div>
 <div class="modal fade" id="dissapproved" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
        
            <div class="modal-content">
                <div class="modal-header w3-green">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Messages Booking</h4></center>
                </div>   
              
                <div class="modal-body"> 
                 <form method="POST" action="includes/delete.php" name="updateform" id="updateform">
             
                      <div class="container-fluid">
                            <div class="form-group input-group">
                               
                                 <input type="hidden" style="width:400px;" class="form-control" id="eids" name="idid" >
                                  <textarea name="msg" id="emessages" class="w3-input w3-border-0" cols="50" rows="10" readonly></textarea>
                            </div>	

                           
                      </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                    
                </div>
                </form>
               
                
                </div>
        </div>
        
    </div>
 </div>
<script>
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
	

    $('#edit').modal('show');
    $('#eid').val(id);

  });
  $(document).on('click', '.dissapproved', function(){
		var id=$(this).val();
    var messages = $('#messages'+id).text();
	

    $('#dissapproved').modal('show');
    $('#eids').val(id);
    $('#emessages').val(messages);

  });
});


</script>
<footer style="margin-left:20%" class="w3-container w3-teal">
  <h5>Footer</h5>
  <p>Footer information goes here</p>
</footer>
    </body>

</html>