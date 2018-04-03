<?php
session_start();
require_once('db_con/live_pdo_con.php');

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 10 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

// $_SESSION["user_email"] = "green";

if( $_POST["submit"] ) {
    # PREPARED STATEMENTS (prepare & execute)
    $user_email = $_POST['username'];
    $country = $_POST['country'];
    $other_selection = $_POST['other-country'];
    $sql = "SELECT * from flag_users WHERE email = ?";
    $v_user = $pdo->prepare($sql);
    $v_user->execute([$user_email]);
    $rows = $v_user->fetch();
    $emailError = "";
    $emailEmptyError = "";
    $otherError = "";
    $countryError = "";

    if (empty($_POST["username"])) {
      $emailEmptyError = "Email is required";

    } else {
      if($rows){

        $sql = "UPDATE flag_users SET chosen_flag = ?, other_selection = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$country, $other_selection, $user_email]);
        $_SESSION["user_email"] = $user_email;
        $_SESSION["other_selection"] = $other_selection;
        $_SESSION["chosen_flag"] = $country;
        // header('Location: success.php');

        if (isset($_POST['country']) && !empty($_POST['country'])) {
          if ( ( $_POST['country'] == "Other" ) && ( empty($_SESSION["other_selection"]) ) ) {
            $otherError = "Country can not be empty";
          } else {
            header('Location: success.php');
          }
        } else {
          $countryError = "Please select a country";
        }

      } else {
        $emailError = "Email is not found";
      }
    }


} else {

}
?>
<html>
 <head>
  <title>Commencement Flags 2018</title>
  <link rel="stylesheet" href="/wp-content/themes/neu-news-wp-theme/static/build/css/style.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
 </head>
 <body>

   <div class="flags-wrapper">
     <div class="flags-top">

       <img class="flags-logo" src="images/NU-logo.svg" alt="Northeastern University Logo" />

       <h1 class="flags-title">Fly Your Flag at Commencement!</h1>
       <div class="flags-content">
                 <div class="intro-text">

                   <p>At Commencement each year, we celebrate the diverse and global makeup of Northeastern’s graduating class. A highlight of the ceremony is when graduates wave flags representing their home country, a location they did a global experience, or a place of importance to them.</p>

                   <p>This year, we are asking students to choose the flag they would like at Commencement this year by using the form below. One flag per graduate. Please submit your choice by Friday, April 20 at 4 p.m.</p>

                   <p>Flags will be available for pick up at cap and gown distribution on Monday, April 30, and Tuesday, May 1, from 9 a.m. to 7 p.m. at the Cabot Center/Solomon Court.</p>
                 </div>
               </div>
             </div>

   <form class="flags-form" id='email' action='<?php $_PHP_SELF ?>' method='POST' accept-charset='UTF-8'>
   <fieldset >
   <input type='hidden' name='submitted' id='submitted' value='1'/>

   <div class='flags-container'>
       <input type='text' class="" placeholder="Your Email" name='username' id='username' maxlength="50">
       <label for='username' >NU email:</label>
       <span class='error <?php if (!empty($emailError)) { echo "visible";} ?>'><?php echo $emailError;?></span>
       <span class='error <?php if (!empty($emailEmptyError)) { echo "visible";} ?>'><?php echo $emailEmptyError;?></span>
   </div>

   <div class='flags-container'>
     <select type='select' name='country' id='country' maxlength='100'>
       <option value="select" selected="selected" disabled>choose country</option>
 <option value="Afghanistan">Afghanistan</option>
 <option value="Akrotiri">Akrotiri</option>
 <option value="Albania">Albania</option>
 <option value="Algeria">Algeria</option>
 <option value="American Samoa">American Samoa</option>
 <option value="Andorra">Andorra</option>
 <option value="Angola">Angola</option>
 <option value="Anguilla">Anguilla</option>
 <option value="Antarctica">Antarctica</option>
 <option value="Antigua and Barbuda">Antigua and Barbuda</option>
 <option value="Argentina">Argentina</option>
 <option value="Armenia">Armenia</option>
 <option value="Aruba">Aruba</option>
 <option value="Ashmore and Cartier Islands">Ashmore and Cartier Islands</option>
 <option value="Australia">Australia</option>
 <option value="Austria">Austria</option>
 <option value="Azerbaijan">Azerbaijan</option>
 <option value="Bahamas">Bahamas</option>
 <option value="Bahrain">Bahrain</option>
 <option value="Baker Island">Baker Island</option>
 <option value="Bangladesh">Bangladesh</option>
 <option value="Barbados">Barbados</option>
 <option value="Belarus">Belarus</option>
 <option value="Belgium">Belgium</option>
 <option value="Belize">Belize</option>
 <option value="Benin">Benin</option>
 <option value="Bermuda">Bermuda</option>
 <option value="Bhutan">Bhutan</option>
 <option value="Bolivia">Bolivia</option>
 <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
 <option value="Botswana">Botswana</option>
 <option value="Bouvet Island">Bouvet Island</option>
 <option value="Brazil">Brazil</option>
 <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
 <option value="Brunei">Brunei</option>
 <option value="Bulgaria">Bulgaria</option>
 <option value="Burkina Faso">Burkina Faso</option>
 <option value="Burma">Burma</option>
 <option value="Burundi">Burundi</option>
 <option value="Cabo Verde">Cabo Verde</option>
 <option value="Cambodia">Cambodia</option>
 <option value="Cameroon">Cameroon</option>
 <option value="Canada">Canada</option>
 <option value="Cayman Islands">Cayman Islands</option>
 <option value="Central African Republic">Central African Republic</option>
 <option value="Chad">Chad</option>
 <option value="Chile">Chile</option>
 <option value="China">China</option>
 <option value="Christmas Island">Christmas Island</option>
 <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
 <option value="Colombia">Colombia</option>
 <option value="Comoros">Comoros</option>
 <option value="Congo (Brazzaville)">Congo (Brazzaville)</option>
 <option value="Congo (Kinshasa)">Congo (Kinshasa)</option>
 <option value="Cook Islands">Cook Islands</option>
 <option value="Coral Sea Islands">Coral Sea Islands</option>
 <option value="Costa Rica">Costa Rica</option>
 <option value="Côte d'Ivoire">Côte d'Ivoire</option>
 <option value="Croatia">Croatia</option>
 <option value="Cuba">Cuba</option>
 <option value="Curaçao">Curaçao</option>
 <option value="Cyprus">Cyprus</option>
 <option value="Czechia">Czechia</option>
 <option value="Denmark">Denmark</option>
 <option value="Dhekelia">Dhekelia</option>
 <option value="Djibouti">Djibouti</option>
 <option value="Dominica">Dominica</option>
 <option value="Dominican Republic">Dominican Republic</option>
 <option value="Ecuador">Ecuador</option>
 <option value="Egypt">Egypt</option>
 <option value="El Salvador">El Salvador</option>
 <option value="England">England</option>
 <option value="Equatorial Guinea">Equatorial Guinea</option>
 <option value="Eritrea">Eritrea</option>
 <option value="Estonia">Estonia</option>
 <option value="Ethiopia">Ethiopia</option>
 <option value="Falkland Islands">Falkland Islands</option>
 <option value="Faroe Islands">Faroe Islands</option>
 <option value="Fiji">Fiji</option>
 <option value="Finland">Finland</option>
 <option value="France">France</option>
 <option value="French Guiana">French Guiana</option>
 <option value="French Polynesia">French Polynesia</option>
 <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
 <option value="Gabon">Gabon</option>
 <option value="Gambia">Gambia</option>
 <option value="Georgia">Georgia</option>
 <option value="Germany">Germany</option>
 <option value="Ghana">Ghana</option>
 <option value="Gibraltar">Gibraltar</option>
 <option value="Greece">Greece</option>
 <option value="Greenland">Greenland</option>
 <option value="Grenada">Grenada</option>
 <option value="Guadeloupe">Guadeloupe</option>
 <option value="Guam">Guam</option>
 <option value="Guatemala">Guatemala</option>
 <option value="Guernsey">Guernsey</option>
 <option value="Guinea">Guinea</option>
 <option value="Guinea-Bissau">Guinea-Bissau</option>
 <option value="Guyana">Guyana</option>
 <option value="Haiti">Haiti</option>
 <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
 <option value="Holy See">Holy See</option>
 <option value="Honduras">Honduras</option>
 <option value="Hong Kong">Hong Kong</option>
 <option value="Howland Island">Howland Island</option>
 <option value="Hungary">Hungary</option>
 <option value="Iceland">Iceland</option>
 <option value="India ">India </option>
 <option value="Indonesia">Indonesia</option>
 <option value="Iran">Iran</option>
 <option value="Iraq ">Iraq </option>
 <option value="Ireland ">Ireland </option>
 <option value="Isle of Man">Isle of Man</option>
 <option value="Israel ">Israel </option>
 <option value="Italy">Italy</option>
 <option value="Jamaica">Jamaica</option>
 <option value="Jan Mayen">Jan Mayen</option>
 <option value="Japan">Japan</option>
 <option value="Jarvis Island">Jarvis Island</option>
 <option value="Jersey">Jersey</option>
 <option value="Johnston Atoll">Johnston Atoll</option>
 <option value="Johnston Atoll">Johnston Atoll</option>
 <option value="Jordan">Jordan</option>
 <option value="Kazakhstan">Kazakhstan</option>
 <option value="Kenya ">Kenya </option>
 <option value="Kingman Reef">Kingman Reef</option>
 <option value="Kiribati">Kiribati</option>
 <option value="Korea, North">Korea, North</option>
 <option value="Korea, South">Korea, South</option>
 <option value="Kosovo">Kosovo</option>
 <option value="Kuwait ">Kuwait </option>
 <option value="Kyrgyzstan">Kyrgyzstan</option>
 <option value="Laos">Laos</option>
 <option value="Latvia ">Latvia </option>
 <option value="Lebanon">Lebanon</option>
 <option value="Lesotho">Lesotho</option>
 <option value="Liberia">Liberia</option>
 <option value="Libya">Libya</option>
 <option value="Liechtenstein">Liechtenstein</option>
 <option value="Lithuania">Lithuania</option>
 <option value="Luxembourg">Luxembourg</option>
 <option value="Macau">Macau</option>
 <option value="Macedonia">Macedonia</option>
 <option value="Madagascar">Madagascar</option>
 <option value="Malawi ">Malawi </option>
 <option value="Malaysia">Malaysia</option>
 <option value="Maldives">Maldives</option>
 <option value="Mali ">Mali </option>
 <option value="Malta">Malta</option>
 <option value="Marshall Islands">Marshall Islands</option>
 <option value="Martinique">Martinique</option>
 <option value="Mauritania">Mauritania</option>
 <option value="Mauritius ">Mauritius </option>
 <option value="Mayotte">Mayotte</option>
 <option value="Mexico">Mexico</option>
 <option value="Micronesia">Micronesia</option>
 <option value="Midway Islands">Midway Islands</option>
 <option value="Moldova">Moldova</option>
 <option value="Monaco ">Monaco </option>
 <option value="Mongolia ">Mongolia </option>
 <option value="Montenegro">Montenegro</option>
 <option value="Montserrat">Montserrat</option>
 <option value="Morocco ">Morocco </option>
 <option value="Mozambique">Mozambique</option>
 <option value="Namibia ">Namibia </option>
 <option value="Nauru">Nauru</option>
 <option value="Navassa Island">Navassa Island</option>
 <option value="Nepal ">Nepal </option>
 <option value="Netherlands">Netherlands</option>
 <option value="New Caledonia">New Caledonia</option>
 <option value="New Zealand ">New Zealand </option>
 <option value="Nicaragua">Nicaragua</option>
 <option value="Niger ">Niger </option>
 <option value="Nigeria ">Nigeria </option>
 <option value="Niue">Niue</option>
 <option value="Norfolk Island">Norfolk Island</option>
 <option value="Northern Ireland">Northern Ireland</option>
 <option value="Northern Mariana Islands">Northern Mariana Islands</option>
 <option value="Norway ">Norway </option>
 <option value="Oman">Oman</option>
 <option value="Pakistan">Pakistan</option>
 <option value="Palau">Palau</option>
 <option value="Palestine">Palestine</option>
 <option value="Palmyra Atoll">Palmyra Atoll</option>
 <option value="Panama">Panama</option>
 <option value="Papua New Guinea">Papua New Guinea</option>
 <option value="Paracel Islands">Paracel Islands</option>
 <option value="Paraguay">Paraguay</option>
 <option value="Peru">Peru</option>
 <option value="Philippines">Philippines</option>
 <option value="Pitcairn Islands">Pitcairn Islands</option>
 <option value="Poland">Poland</option>
 <option value="Portugal">Portugal</option>
 <option value="Puerto Rico">Puerto Rico</option>
 <option value="Qatar">Qatar</option>
 <option value="Reunion">Reunion</option>
 <option value="Romania">Romania</option>
 <option value="Russia">Russia</option>
 <option value="Rwanda">Rwanda</option>
 <option value="Saint Barthelemy">Saint Barthelemy</option>
 <option value="Saint Helena, Ascension, and Tristan da Cunha">Saint Helena, Ascension, and Tristan da Cunha</option>
 <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
 <option value="Saint Lucia">Saint Lucia</option>
 <option value="Saint Martin">Saint Martin</option>
 <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
 <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
 <option value="Samoa">Samoa</option>
 <option value="San Marino">San Marino</option>
 <option value="Sao Tome and Principe">Sao Tome and Principe</option>
 <option value="Saudi Arabia">Saudi Arabia</option>
 <option value="Scotland">Scotland</option>
 <option value="Senegal ">Senegal </option>
 <option value="Serbia">Serbia</option>
 <option value="Seychelles">Seychelles</option>
 <option value="Sierra Leone ">Sierra Leone </option>
 <option value="Singapore">Singapore</option>
 <option value="Sint Maarten">Sint Maarten</option>
 <option value="Slovakia">Slovakia</option>
 <option value="Slovenia">Slovenia</option>
 <option value="Solomon Islands">Solomon Islands</option>
 <option value="Somalia">Somalia</option>
 <option value="South Africa">South Africa</option>
 <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
 <option value="South Sudan">South Sudan</option>
 <option value="Spain ">Spain </option>
 <option value="Spratly Islands">Spratly Islands</option>
 <option value="Sri Lanka">Sri Lanka</option>
 <option value="Sudan">Sudan</option>
 <option value="Suriname ">Suriname </option>
 <option value="Svalbard">Svalbard</option>
 <option value="Swaziland">Swaziland</option>
 <option value="Sweden">Sweden</option>
 <option value="Switzerland">Switzerland</option>
 <option value="Syria">Syria</option>
 <option value="Taiwan">Taiwan</option>
 <option value="Tajikistan">Tajikistan</option>
 <option value="Tanzania">Tanzania</option>
 <option value="Thailand">Thailand</option>
 <option value="Timor-Leste">Timor-Leste</option>
 <option value="Togo">Togo</option>
 <option value="Tokelau">Tokelau</option>
 <option value="Tonga">Tonga</option>
 <option value="Trinidad and Tobago">Trinidad and Tobago</option>
 <option value="Tunisia">Tunisia</option>
 <option value="Turkey">Turkey</option>
 <option value="Turkmenistan">Turkmenistan</option>
 <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
 <option value="Tuvalu">Tuvalu</option>
 <option value="Uganda">Uganda</option>
 <option value="Ukraine">Ukraine</option>
 <option value="United Arab Emirates">United Arab Emirates</option>
 <option value="United Kingdom">United Kingdom</option>
 <option value="United States">United States</option>
 <option value="Uruguay">Uruguay</option>
 <option value="Uzbekistan">Uzbekistan</option>
 <option value="Vanuatu">Vanuatu</option>
 <option value="Venezuela">Venezuela</option>
 <option value="Vietnam">Vietnam</option>
 <option value="Virgin Islands, British">Virgin Islands, British</option>
 <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
 <option value="Wake Island">Wake Island</option>
 <option value="Wales">Wales</option>
 <option value="Wallis and Futuna">Wallis and Futuna</option>
 <option value="Western Sahara">Western Sahara</option>
 <option value="Yemen">Yemen</option>
 <option value="Zambia">Zambia</option>
 <option value="Zimbabwe">Zimbabwe</option>
 <option value="Other">Other</option>
</select>
<label for='country'>Selected Flag:</label>
<span class='error <?php if (!empty($countryError)) { echo "visible";} ?>'><?php echo $countryError;?></span>
   </div>

   <div class='flags-container other'>
               <input type='text' name='other-country' id='other-country' maxlength="50" />
               <label for='other-country' >Other:</label>
               <span class='error <?php if (!empty($otherError)) { echo "visible";} ?>'><?php echo $otherError;?></span>
           </div>

   <div class='flags-container'>
       <input type='submit' name='submit' value='Submit' />
   </div>
   </fieldset>
   </form>

   <div class="flags-footer"></div>
   </div>

   <script src="js/main.js"></script>
 </body>
</html>
