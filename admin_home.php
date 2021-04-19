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
    <head></head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <!-- <link rel="stylesheet" href="css/js/jquery.min.js">
    <link rel="stylesheet" href="css/js/bootstrap.min.css">
    <script src="css/js/jquery.min1.js"></script>
    <script src="css/js/bootstrap.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <body>
  <div class="w3-sidebar w3-light-grey w3-bar-block" style="width:20%;">
    <div class="w3-container w3-teal">
    <br><br>
    <img src="icons/avatar.png" alt="Avatar" class="w3-left w3-circle w3-margin-right">
    <p><?php echo $_SESSION['completename'];?></p>
    <a href="includes/logout.php">Logout</a>
      <hr>
    </div>
  <h3 class="w3-bar-item">Menu</h3>
  <a href="#" class="w3-bar-item w3-button">Link 1</a>
  <a href="#" class="w3-bar-item w3-button">Link 2</a>
  <a href="#" class="w3-bar-item w3-button">Link 3</a>
</div>
    <div style="margin-left:20%" class="w3-container w3-teal">
    <h1>Booking Ticket</h1>
</div>
<div class="w3-container" style="margin-left:20%">
    <div class="w3-row">
        <div class="w3-third w3-center">
             <h3>MON</h3>
             <img src="img_weather_sun.jpg" alt="sun">
        </div>
        <div class="w3-third w3-center">
                <h3>TUE</h3>
                <img src="img_weather_cloud.jpg" alt="cloud">
        </div>
        <div class="w3-third w3-center w3-margin-bottom">
                <h3>WED</h3>
                <img src="img_weather_clouds.jpg" alt="clouds">
        </div>
        
    </div>

  <div class="w3-container">
        <table  width="100%" class="w3-table-all w3-hoverable">
		<thead>
       <th>Book Name</th>
			<th>Reference Number</th>
			<th>Booking Date</th>
      <th>Boat Name</th>
      <th>Ticket Name</th>
      <th>Type</th>
      <th>Price</th>
      <th>Attachment</th>
      <th>Action</th>
		</thead>
		<tbody>
        <?php
       
      $query=mysqli_query($conn,"select * from `booking_tb` ");
        if ($query->num_rows > 0) {       
          while($row=mysqli_fetch_array($query)){
            ?> 
           
            <tr>
            <td><span id="bookname<?php echo $row['booking_id']; ?>"><?php echo $row['user_name']; ?></span></td>
            <td><span id="reference<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_reference']; ?></span></td>
            <td><span id="bookingdate<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_date']; ?></span></td>
            <td><span id="boatname<?php echo $row['booking_id']; ?>"><?php echo $row['Boat_name']; ?></span></td>
            <td><span id="tcktname<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_tckt_name']; ?></span></td>
            <td><span id="bookingtype<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_type']; ?></span></td>
            <td><span id="bookingprice<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_price']; ?></span></td>
            <td><span id="attach<?php echo $row['booking_id']; ?>"><?php echo $row['Booking_attachment']; ?></span></td>
            <td>
                <?php
                    if($row['book_status']== 1)
                    {
                      echo " <button type='button' class='btn btn-success edit' value='".$row['booking_id']."'><span class='glyphicon glyphicon-edit'></span> Validate</button>";
                    }else{
                      echo"Validated";
                    }
                ?>

            </td>
            </tr>

            <?php 
          }
			}
		?>		
    </tbody>
 	</table>  
              
  </div>
  
</div> 


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
        
            <div class="modal-content">
                <div class="modal-header w3-teal">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Validate Ticket</h4></center>
                </div>   
              
                <div class="modal-body"> 
                 <form method="POST" name="updateform" id="updateform">
             
                      <div class="container-fluid">
                      <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Book Name</span>
                          <input type="text" style="width:400px;" class="form-control" id="ebookname" name="bookname">
                        </div>	
                      
                        <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Reference Number:</span>
                          <input type="text" style="width:400px;" class="form-control" id="ereference" name="reference">
                        </div>	
                        <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Booking Date</span>
                          <input type="text" style="width:400px;" class="form-control" id="ebookingdate" > 
                        </div>	
                        <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Boat Name</span>
                          <input type="text" style="width:400px;" class="form-control" id="eboatname" >
                          </div>
                          <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Ticket Name</span>
                          <input type="text" style="width:400px;" class="form-control" id="etcktname" >
                          </div>
                          <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Type</span>
                          <input type="text" style="width:400px;" class="form-control" id="ebookingtype" >
                          </div>
                          <div class="form-group input-group">
                          <span class="input-group-addon" style="width:150px;">Price</span>
                          <input type="text" style="width:400px;" class="form-control" id="ebookingprice" >
                          </div>
                        <div class="form-group input-group">
                          <div id="container" style="width: 50%;"></div>
                        </div>
                      
                      </div>
                     </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="button" id="update" name="update" class="btn btn-success"  ><span class="glyphicon glyphicon-edit"></span> </i> Update</button>
                </div>
                </form>
                <?php
                ?>
                </div>
        </div>
        
    </div>
 
<script>
$(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var bookname=$('#bookname'+id).text();
    var reference=$('#reference'+id).text();
    var bookingdate=$('#bookingdate'+id).text();
    var boatname=$('#boatname'+id).text();
    var tcktname=$('#tcktname'+id).text();
    var bookingtype=$('#bookingtype'+id).text();
    var bookingprice=$('#bookingprice'+id).text();
    var attach=$('#attach'+id).text();



    $('#edit').modal('show');
    $('#eid').val(id);
		$('#ebookname').val(bookname);
    $('#ereference').val(reference);
    $('#ebookingdate').val(bookingdate);
    $('#eboatname').val(boatname);
    $('#etcktname').val(tcktname);
    $('#ebookingtype').val(bookingtype);
    $('#ebookingprice').val(bookingprice);

    $('#eattach').val(attach);
    document.getElementById("container").innerHTML = "<img src='uploads/"+attach+"' class='w3-border w3-padding' width='200%'>";
  });
  $("#update").click(function(){
         $.ajax({
     type: "POST",
 url: "updatestatus.php",
 data: $('form.updateform').serialize(),
         success: function(msg){
                 alert(msg);
        $("#edit").modal('hide'); 
         },
 error: function(){
 alert("failure");
 }
       });
 })
});

var ref = document.getElementById("references").value;
document.getElementById("total").innerHTML=ref;
$( "#create" ).click(function() {
  alert( "Handler for .click() called." );
});

</script>
<footer style="margin-left:20%" class="w3-container w3-teal">
  <h5>Footer</h5>
  <p>Footer information goes here</p>
</footer>
    </body>

</html>