<?php
// if(session_id() == '' || !isset($_SESSION)) {
//     // session isn't started
// }
session_start();
ini_set('smtp_port', 2025);

$flag_selection = "test";
$email = $_SESSION["user_email"];

if(isset($_SESSION['other_selection']) && !empty($_SESSION['other_selection'])) {
  $flag_selection = $_SESSION['other_selection'];
} else {
  $flag_selection = $_SESSION['chosen_flag'];
}


$subject = 'Commencement Flag Selection';

$message = '<html><head><title>Commencement Flag Selection</title></head><body>';
$message .= '<table><tr><td><p>Thanks for your submission!</p>';
$message .= '<p>You have successfully registered to receive a flag from '. $flag_selection . '</p>';
$message .= '<p>If you have any questions, or if this selection is incorrect, please email flags@northeastern.edu.</p>';
$message .= '<p>Flags will be available for pickup at cap and gown distribution on Monday, April 30, and Tuesday, May 1, in the Cabot Center/Solomon Court from 9 am to 7 pm.</p>';
$message .= '</td></tr></table></body></html>';

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <flags@northeastern.edu>' . "\r\n" ;
$headers .= 'Reply-To: <flags@northeastern.edu>' . "\r\n";
$headers .= 'X-Mailer: PHP/' . phpversion();

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
      // last request was more than 10 minutes ago
      session_unset();     // unset $_SESSION variable for the run-time
      session_destroy();   // destroy session data in storage
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

?>

<html>
 <head>
   <title>Commencement Flags 2018</title>
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

 </head>
 <body>

   <div class="flags-wrapper--success">
     <div class="flags-top--success">

       <img class="flags-logo" src="images/NU-logo.svg" alt="Northeastern University Logo" />

       <div class="flags-content">
           <div class="return-message">

             <p>Email: <?php echo $email; ?></p>
             <p>Flag: <?php echo $flag_selection; ?></p>

             <?php if (mail($_SESSION["user_email"], $subject, $message, $headers)) {
            ?>
            <p>Thanks for your submission!</p>

            <p>The form was submitted with the following email and flag selection.</p>
           
            <p><?php echo  $email ?></p>
            <p><?php echo  $flag_selection; ?></p>

           
            <p>If you have any questions or if this selection is incorrect, please email flags@northeastern.edu with the details of your inquiry for more information.</p>
           
            <p>Flags will be available for pickup at cap and gown distribution on Monday, April 30, and Tuesday, May 1, in the Cabot Center/Solomon Court from 9 am to 7 pm.</p>

            <?php
            } else {
            ?>
            <h3>Something went wrong, a confirmation email was not sent.  Please try again.</h3>
            <?php
            } ?>
          </div>
        </div>
  </div>

 <script src="js/main.js"></script>
</body>
</html>


<!-- <?php
  $_SESSION["user_email"] = NULL;
?> -->
