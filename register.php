<!doctype HTML>
<html lang='en'>
    <title>Angasil Online Ticket System</title>
    <head></head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <body>
        <section class="w3-container w3-display-middle w3-teal w3-padding w3-card-4" style="width: 40%;">
            <form action="includes/user_register.php" class="w3-container" method="post">
                <label> Your Name:</label>
                <input type="text" placeholder="Firstname|Middlename|Surname" class="w3-input w3-border" name="yourname" required>
                <br>
                <label> Complete Address:</label>
                <input type="text" placeholder=""class="w3-input w3-border" name="address" required>
                 <br>
                 <label> Email Address:</label>
                 <input type="email" placeholder=""class="w3-input w3-border" name="emailadd" required>
                 <br>
                 <label> Username</label>
                 <input type="text" placeholder="username"class="w3-input w3-border" name="username" required>
                 <br>
                <label> Password</label>
                 <input type="password" placeholder="Password"class="w3-input w3-border" name="password" required>
                 <br>
                 <label> Confirm Password</label>
                 <input type="password" placeholder="Password" class="w3-input w3-border"name="confirmpw" required>
                 <br>
                <button class="w3-btn  w3-green" name="register">Submit</button>
                <button class="w3-btn  w3-red" name="cancel"><a href="index.php">Cancel</a></button>
            </form>
        </section>
    </body>
</html>