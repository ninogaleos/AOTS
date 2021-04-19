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
        
    <script type="text/javascript">
       
     function selectOnChange(obj) {
          var val = obj.options[obj.selectedIndex].value;
         var text = obj.options[obj.selectedIndex].text;
         document.getElementById("field1").value = val;
         document.getElementById("field2").value = text;
        document.getElementById('TOTAL').value = c;
      }
      function multiply() {
        a = Number(document.getElementById('QTY').value);
         b = Number(document.getElementById('field1').value);
         c = a * b;

     document.getElementById('TOTAL').value = c;
}
function addequation(){

}

</script>
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <body>
        <section">
            <div class="head-nav">
                <div class="logo"></div>
                    <div class="menu-nav">
                        <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
                        <a href="#"><i class="fa fa-fw fa-user"></i> My Account</a>
                        <a href="#"><i class="fa fa-fw fa-user"></i>FAQ</a>
                        <a href="#"><i class="fa fa-fw fa-user"></i>Contact Us</a>
                        <a href="#"><i class="fa fa-fw fa-user"></i>About Us</a>
                        
                    </div>
            </div>
            <div class="left-nav">
            <?php
                echo $_SESSION['completename'];
            ?>
            <a href="includes/logout.php">Logout</a>
            </div>
            <div class="page-content">
               <section class="col-aln">
                   <div class="col-aln-1">Regular</div>
                   <div class="col-aln-1">Student</div>
                   <div class="col-aln-1">Senior Citizen</div>
                   <div class="col-aln-1">PWD</div>
               </section>
                
                <form action="includes/add_cart.php" class="col-aln-center" method="post" enctype="multipart/form-data">
                <h4>Add Ticket</h4>
                <label>Type:</label>
                    <select onchange='selectOnChange(this)' name="ticketType" >
                        <option value=""></option>
                        <option value="20">Regular</option>
                        <option value="15">Student</option>
                        <option value="12">Senior Citizen</option>
                        <option value="12">PWD</option>
                    </select>
                    <input type="text" id="field2" name="type" hidden>
                    <br>
                   
                    <label >Price:</label>
                    <input type="text" id="field1" name="price">
                    <br> 
                    <label>upload files</label>
                    <input type="file" name="attachment-pic" accept="image/*" required>
                    <!-- <label>Quantity:</label>
                    <input type="text" id="QTY" onKeyUp="multiply()" name="quantity"> -->
                    <!-- <label>TOTAL</label>
                    <input type="text" id="TOTAL" name="total"> -->
                    
                    <button name="addCart">Submit</button>
                </form>

               <div class="col-aln-right">
               <form action="includes/add_book.php" method="post" enctype="multipart/form-data">
                 <table width="">
                                <tr>
                                    <th></th>
                                    <th>Ticket Number</th>
                                    <th>Ticket Type</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                       <?php
                    include "includes/connection.php";
                    $ids = $_SESSION['id'];
                    $sql= "SELECT * FROM ticket_cart where user_id=$ids order by ticket_date desc";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $resultSet = $stmt->get_result();
                    $result = $resultSet->fetch_all();?>
                   
                           
                            <?php foreach($result as $row){   $extractedDAte = $row[4];?>
                                    <td><input type="text" name='id' value="<?php echo $row['0'];?>" hidden></td>
                                    <td><input type="text" name="tckt_number" value="<?php echo $row[1];?>" ></t>
                                    <td><input type="text" name="tckt_type" value="<?php echo $row[2];?>" ></td>
                                    <td><input type="text" name="prices" value="<?php echo $row[3];?>" ></td>
                                    <td><button name="delete"><i class="fa fa-remove">DElete</i></button></td>
                                </tr>
                            <?php } ?>
                                <tfoot> 
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:right;">TOTAL</td>
                                        
                                        <td>
                                        <?php
                                         $sqls= "SELECT * FROM ticket_cart where user_id=$ids";
                                         $stmts = $conn->prepare($sql);
                                         $stmts->execute();
                                         $resultSets = $stmts->get_result();
                                         $results = $resultSets->fetch_all();
                                         $qty=0;
                                         foreach($result as $row){
                                             $qty += $row[3];
                                         }
                                        
                                        ?>
                                            <input type="number" name="tckt_overtotal" id="totalequals" value="<?php echo $qty;?>"  >

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                     <div>
                        

                     </div>
                            <h4>Pay this thru GCASH</h4>
                                <p>Scan the QRCODE or pay in send money</p>
                                <a href="https://help.gcash.com/hc/en-us/articles/360017722773-How-to-Pay-QR-using-the-GCash-App" target="_blank">How to pay using Gcash using QR/Barcode</a>
                                <span></span>
                               
                                         <label>Reference Number</label>
                                         <input type="text" placeholder="Reference number given by GCASH" name="reference">

                                       <button name="addbook">Book Ticket</button>
                                </form>      
               </div>
                   
            </div>
           
        </section>
    </body>
</html>
