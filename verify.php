<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <form  method="POST">
           <input type="number" placeholder='Verify OTP' name="input_otp" id=""> 
           <button name="submit" type="submit">verify</button>
           <?php
session_start();
    if($_SERVER['REQUEST_METHOD']=="POST"){
    $input_otp = $_POST['input_otp'];
    if(isset($_SESSION['otp'])  && $input_otp == $_SESSION['otp']){
   echo "<script>alert(' you have successfully complete the registration')</script>";
   header("Location: allusers.php"); 
    }
    else{
       echo '<h2 style="color:red;">otp is incorrect</h2>';   
    //    header("Location: verify.php");    
    }
    }

?>
        </form>
    </div>
</body>
</html>
