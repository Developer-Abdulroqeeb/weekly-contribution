 <?php
 session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// $errormsg= '';
// $error= '';
// $msg = '';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // random number of otp
        $otp = mt_rand(1000,9999);
        $_SESSION['otp'] = $otp;
//   verifying the gmail       
        $to = filter_var(trim($_POST["gmail"]), FILTER_SANITIZE_EMAIL);
        // Validate email
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email address.";
            exit;
        }
            // random for when they are collecting money
            $rand = mt_rand(1, 10); 
            // meating the random number condition
            // declaring the input variable
            $username = $_POST['username'];
            $date = $_POST['date'];
            $gmail = $_POST['gmail'];
            // session
            $_SESSION['username']= $_POST['username'];
             $_SESSION['date'] = $_POST['date'];
             $_SESSION['gmail'] = $_POST['gmail'];
           //  date management
           $dates = new DateTime();
           $dates->modify("+$rand weeks"); 
           $newWeekDate = $dates->format('Y-m-d');  
           $_SESSION['newWeekDate'] =  $newWeekDate;
            // database
            // function to send otp to mail
                $connection= mysqli_connect("localhost", "root", "", "contribution"); 
                $select = "SELECT * FROM contribute WHERE gmail='$to'";
                $select_query = mysqli_query($connection,$select);
                $rand_select = "SELECT * FROM contribute WHERE number_pick='$rand'";
                $rand_query = mysqli_query($connection,$rand_select);
                if(mysqli_num_rows($select_query)>0 && mysqli_num_rows($select_query)>0 ){
                    $msg = 'both email and number given to you already exist';
                }
              elseif(mysqli_num_rows($select_query)>0){
          $errormsg = "email already choosen";
    
              }elseif(mysqli_num_rows($rand_query)>0){
     $error = "number given to you already exist register again";
              }
              else{
                   $query = "INSERT INTO contribute (username, date,gmail,collection_date,number_pick) VALUES ('$username', '$date','$gmail','$newWeekDate','$rand')";
                    $result = mysqli_query($connection,$query);
                  function sendOtpEmail($to,$otp){  
                    $mail = new PHPMailer(true);
                try {
                   
                    // SMTP settings
                    $mail->isSMTP(); // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com'; // Your SMTP server (e.g., smtp.gmail.com)
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'testmemail2003@gmail.com'; //t Your email address
                    $mail->Password = 'hsxwmbptncvzqmhf'; // Your email password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
                    $mail->Port = 465; // TCP port to connect to
                    // Recipients
                    $mail->setFrom('testmemail2003@gmail.com', 'Muslim coperative'); // Your email and name
                    $mail->addAddress($to); 
                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = "Daily Contribution" ;
                    $mail->Body    = 'Hi'."  ".$username."  "."you have succesfully register for the daily contribution and your number is"."  " .$rand."  ". "so you
                    will be collecting your money on the"."  ".$newWeekDate."  ". "which is"."  " .$rand."  ". "weeks time enter this otp to verify it is you"."  ".$otp;
                //    senfing mail
                $mail->send();
                    echo "Email sent successfully to $to.";
                } catch (Exception $e)  {
                    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }   
                
                header("Location: verify.php");
               }
               sendOtpEmail($to,$otp);
              
        }
        
 
            // sending mail
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styl.css">
    <style>

    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" id='container'>
    <form id="myform"  method="POST">
    <?php if(isset($errormsg)){?><p><span><?php echo $errormsg;?></span><?php } ?>
    <?php if(isset($error)){?> <span><?php echo $error;?></span><?php } ?>
        <?php if(isset($msg)){?><span><?php echo $msg; ?></span> </p><?php } ?>
       
        <input type="text" required placeholder="Username" name="username" id="">
        <input type="email" required name="gmail" placeholder="enter your gmail" name="username" id="">
        <input type="date" readonly name="date" id="date">
        <input type="hidden" value="">
        <input type="submit"   class="submit" value="submit">
    </form>
    </div>
    <!-- <div class="verification" id='verification'>
    <form action="" id="otp-form"  method="POST">
        <input type="number" required placeholder="Username" name="otpu" id="">
        <input type="submit"   class="submit" value="submit">
    </form>
    </div>   -->
    <script src="script.js"></script>
</body>

</html>