<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
ini_set('smtp_port', 2025);
$subject = 'Commencement Flag Selection';
$message = 'Hello. You have successfully registered to recieve a flag from '. $_SESSION["chosen_flag"] . ' If you believe this was an error, please contact us';
$headers = 'From: flags@huskynunews.wpengine.com/' . "\r\n" .
    'Reply-To: flags@huskynunews.wpengine.com/' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
      // last request was more than 30 minutes ago
      session_unset();     // unset $_SESSION variable for the run-time
      session_destroy();   // destroy session data in storage
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

?>

<html>
 <head>
  <title>PHP Test</title>
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

             <?php if (mail($_SESSION["user_email"], $subject, $message, $headers)) {
            ?>
            <p>Thanks for your submission!</p>

            <p>The form was submitted with the following email and flag selection.</p>
           
            <p><?php echo  $_SESSION["user_email"]; ?></p>
            <p><?php echo  $_SESSION["chosen_flag"]; ?></p>

           
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

  <!-- <div class="flags-footer"></div> -->
  </div>

 <script src="js/main.js"></script>
</body>
</html>


<!-- <?php
  $_SESSION["user_email"] = NULL;
?> -->
