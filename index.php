<?php
session_start();
require_once('db_con/live_pdo_con.php');

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 10 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp



$_SESSION["user_email"] = "green";
if( $_POST["submit"] ) {
    # PREPARED STATEMENTS (prepare & execute)
    $user_email = $_POST['username'];
    $country = $_POST['country'];
    $other = $_POST['other'];
    $sql = "SELECT * from flag_users WHERE email = ?";
    $v_user = $pdo->prepare($sql);
    $v_user->execute([$user_email]);
    $rows = $v_user->fetch();

    if($rows){

      $sql = "UPDATE flag_users SET chosen_flag = ?, other SET other = ? WHERE email = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$country, $user_email, $other]);
      header('Location: success.php');
      if (isset($_POST['country']) && !empty($_POST['country'])) {
        header('Location: success.php');
      }
      $_SESSION["user_email"] = $user_email;
      $_SESSION["chosen_flag"] = $country;

    } else {
      echo $user_email . " email not found, please try again.";
      die();
    }

} else {

}
?>
<html>
 <head>
  <title>PHP Test</title>
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

                   <p>This year, we are asking students to choose the flag they would like at Commencement this year by using the form below. One flag per graduate.</p>

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
       <span id='login_username_errorloc' class='error'></span>
   </div>

   <div class='flags-container'>
      <select type='select' name='country' id='country' value='test' maxlength='100'>
  <option value="select">choose country</option>
  <option value="other">Other</option>
  <option value="afghanistan">Afghanistan</option>
	<option value="akrotiri">Akrotiri</option>
	<option value="albania">Albania</option>
	<option value="algeria">Algeria</option>
	<option value="american_samoa">American Samoa</option>
	<option value="andorra">Andorra</option>
	<option value="angola">Angola</option>
	<option value="anguilla">Anguilla</option>
	<option value="antarctica">Antarctica</option>
	<option value="antigua_and_barbuda">Antigua and Barbuda</option>
	<option value="argentina">Argentina</option>
	<option value="armenia">Armenia</option>
	<option value="aruba">Aruba</option>
	<option value="ashmore_and_cartier_islands">Ashmore and Cartier Islands</option>
	<option value="australia">Australia</option>
	<option value="austria">Austria</option>
	<option value="azerbaijan">Azerbaijan</option>
	<option value="bahamas">Bahamas</option>
	<option value="bahrain">Bahrain</option>
	<option value="baker_island">Baker Island</option>
	<option value="bangladesh">Bangladesh</option>
	<option value="barbados">Barbados</option>
	<option value="belarus">Belarus</option>
	<option value="belgium">Belgium</option>
	<option value="belize">Belize</option>
	<option value="benin">Benin</option>
	<option value="bermuda">Bermuda</option>
	<option value="bhutan">Bhutan</option>
	<option value="bolivia">Bolivia</option>
	<option value="bosnia_and_herzegovina">Bosnia and Herzegovina</option>
	<option value="botswana">Botswana</option>
	<option value="bouvet_island">Bouvet Island</option>
	<option value="brazil">Brazil</option>
	<option value="british_indian_ocean_territory">British Indian Ocean Territory</option>
	<option value="brunei">Brunei</option>
	<option value="bulgaria">Bulgaria</option>
	<option value="burkina_faso">Burkina Faso</option>
	<option value="burma">Burma</option>
	<option value="burundi">Burundi</option>
	<option value="cabo_verde">Cabo Verde</option>
	<option value="cambodia">Cambodia</option>
	<option value="cameroon">Cameroon</option>
	<option value="canada">Canada</option>
	<option value="cayman_islands">Cayman Islands</option>
	<option value="central_african_republic">Central African Republic</option>
	<option value="chad">Chad</option>
	<option value="chile">Chile</option>
	<option value="china">China</option>
	<option value="christmas_island">Christmas Island</option>
	<option value="cocos_(keeling)_islands">Cocos (Keeling) Islands</option>
	<option value="colombia">Colombia</option>
	<option value="comoros">Comoros</option>
	<option value="congo_(brazzaville)">Congo (Brazzaville)</option>
	<option value="congo_(kinshasa)">Congo (Kinshasa)</option>
	<option value="cook_islands">Cook Islands</option>
	<option value="coral_sea_islands">Coral Sea Islands</option>
	<option value="costa_rica">Costa Rica</option>
	<option value="côte_d'ivoire">Côte d'Ivoire</option>
	<option value="croatia">Croatia</option>
	<option value="cuba">Cuba</option>
	<option value="curaçao">Curaçao</option>
	<option value="cyprus">Cyprus</option>
	<option value="czechia">Czechia</option>
	<option value="denmark">Denmark</option>
	<option value="dhekelia">Dhekelia</option>
	<option value="djibouti">Djibouti</option>
	<option value="dominica">Dominica</option>
	<option value="dominican_republic">Dominican Republic</option>
	<option value="ecuador">Ecuador</option>
	<option value="egypt">Egypt</option>
	<option value="el_salvador">El Salvador</option>
	<option value="england">England</option>
	<option value="equatorial_guinea">Equatorial Guinea</option>
	<option value="eritrea">Eritrea</option>
	<option value="estonia">Estonia</option>
	<option value="ethiopia">Ethiopia</option>
	<option value="falkland_islands">Falkland Islands</option>
	<option value="faroe_islands">Faroe Islands</option>
	<option value="fiji">Fiji</option>
	<option value="finland">Finland</option>
	<option value="france">France</option>
	<option value="french_guiana">French Guiana</option>
	<option value="french_polynesia">French Polynesia</option>
	<option value="french_southern_and_antarctic_lands">French Southern and Antarctic Lands</option>
	<option value="gabon">Gabon</option>
	<option value="gambia">Gambia</option>
	<option value="georgia">Georgia</option>
	<option value="germany">Germany</option>
	<option value="ghana">Ghana</option>
	<option value="gibraltar">Gibraltar</option>
	<option value="greece">Greece</option>
	<option value="greenland">Greenland</option>
	<option value="grenada">Grenada</option>
	<option value="guadeloupe">Guadeloupe</option>
	<option value="guam">Guam</option>
	<option value="guatemala">Guatemala</option>
	<option value="guernsey">Guernsey</option>
	<option value="guinea">Guinea</option>
	<option value="guinea-bissau">Guinea-Bissau</option>
	<option value="guyana">Guyana</option>
	<option value="haiti">Haiti</option>
	<option value="heard_island_and_mcdonald_islands">Heard Island and McDonald Islands</option>
	<option value="holy_see">Holy See</option>
	<option value="honduras">Honduras</option>
	<option value="hong_kong">Hong Kong</option>
	<option value="howland_island">Howland Island</option>
	<option value="hungary">Hungary</option>
	<option value="iceland">Iceland</option>
	<option value="india_">India </option>
	<option value="indonesia">Indonesia</option>
	<option value="iran">Iran</option>
	<option value="iraq_">Iraq </option>
	<option value="ireland_">Ireland </option>
	<option value="isle_of_man">Isle of Man</option>
	<option value="israel_">Israel </option>
	<option value="italy">Italy</option>
	<option value="jamaica">Jamaica</option>
	<option value="jan_mayen">Jan Mayen</option>
	<option value="japan">Japan</option>
	<option value="jarvis_island">Jarvis Island</option>
	<option value="jersey">Jersey</option>
	<option value="johnston_atoll">Johnston Atoll</option>
	<option value="johnston_atoll">Johnston Atoll</option>
	<option value="jordan">Jordan</option>
	<option value="kazakhstan">Kazakhstan</option>
	<option value="kenya_">Kenya </option>
	<option value="kingman_reef">Kingman Reef</option>
	<option value="kiribati">Kiribati</option>
	<option value="korea,_north">Korea, North</option>
	<option value="korea,_south">Korea, South</option>
	<option value="kosovo">Kosovo</option>
	<option value="kuwait_">Kuwait </option>
	<option value="kyrgyzstan">Kyrgyzstan</option>
	<option value="laos">Laos</option>
	<option value="latvia_">Latvia </option>
	<option value="lebanon">Lebanon</option>
	<option value="lesotho">Lesotho</option>
	<option value="liberia">Liberia</option>
	<option value="libya">Libya</option>
	<option value="liechtenstein">Liechtenstein</option>
	<option value="lithuania">Lithuania</option>
	<option value="luxembourg">Luxembourg</option>
	<option value="macau">Macau</option>
	<option value="macedonia">Macedonia</option>
	<option value="madagascar">Madagascar</option>
	<option value="malawi_">Malawi </option>
	<option value="malaysia">Malaysia</option>
	<option value="maldives">Maldives</option>
	<option value="mali_">Mali </option>
	<option value="malta">Malta</option>
	<option value="marshall_islands">Marshall Islands</option>
	<option value="martinique">Martinique</option>
	<option value="mauritania">Mauritania</option>
	<option value="mauritius_">Mauritius </option>
	<option value="mayotte">Mayotte</option>
	<option value="mexico">Mexico</option>
	<option value="micronesia">Micronesia</option>
	<option value="midway_islands">Midway Islands</option>
	<option value="moldova">Moldova</option>
	<option value="monaco_">Monaco </option>
	<option value="mongolia_">Mongolia </option>
	<option value="montenegro">Montenegro</option>
	<option value="montserrat">Montserrat</option>
	<option value="morocco_">Morocco </option>
	<option value="mozambique">Mozambique</option>
	<option value="namibia_">Namibia </option>
	<option value="nauru">Nauru</option>
	<option value="navassa_island">Navassa Island</option>
	<option value="nepal_">Nepal </option>
	<option value="netherlands">Netherlands</option>
	<option value="new_caledonia">New Caledonia</option>
	<option value="new_zealand_">New Zealand </option>
	<option value="nicaragua">Nicaragua</option>
	<option value="niger_">Niger </option>
	<option value="nigeria_">Nigeria </option>
	<option value="niue">Niue</option>
	<option value="norfolk_island">Norfolk Island</option>
	<option value="northern_ireland">Northern Ireland</option>
	<option value="northern_mariana_islands">Northern Mariana Islands</option>
	<option value="norway_">Norway </option>
	<option value="oman">Oman</option>
	<option value="pakistan">Pakistan</option>
	<option value="palau">Palau</option>
	<option value="palestine">Palestine</option>
	<option value="palmyra_atoll">Palmyra Atoll</option>
	<option value="panama">Panama</option>
	<option value="papua_new_guinea">Papua New Guinea</option>
	<option value="paracel_islands">Paracel Islands</option>
	<option value="paraguay">Paraguay</option>
	<option value="peru">Peru</option>
	<option value="philippines">Philippines</option>
	<option value="pitcairn_islands">Pitcairn Islands</option>
	<option value="poland">Poland</option>
	<option value="portugal">Portugal</option>
	<option value="puerto_rico">Puerto Rico</option>
	<option value="qatar">Qatar</option>
	<option value="reunion">Reunion</option>
	<option value="romania">Romania</option>
	<option value="russia">Russia</option>
	<option value="rwanda">Rwanda</option>
	<option value="saint_barthelemy">Saint Barthelemy</option>
	<option value="saint_helena,_ascension,_and_tristan_da_cunha">Saint Helena, Ascension, and Tristan da Cunha</option>
	<option value="saint_kitts_and_nevis">Saint Kitts and Nevis</option>
	<option value="saint_lucia">Saint Lucia</option>
	<option value="saint_martin">Saint Martin</option>
	<option value="saint_pierre_and_miquelon">Saint Pierre and Miquelon</option>
	<option value="saint_vincent_and_the_grenadines">Saint Vincent and the Grenadines</option>
	<option value="samoa">Samoa</option>
	<option value="san_marino">San Marino</option>
	<option value="sao_tome_and_principe">Sao Tome and Principe</option>
	<option value="saudi_arabia">Saudi Arabia</option>
	<option value="scotland">Scotland</option>
	<option value="senegal_">Senegal </option>
	<option value="serbia">Serbia</option>
	<option value="seychelles">Seychelles</option>
	<option value="sierra_leone_">Sierra Leone </option>
	<option value="singapore">Singapore</option>
	<option value="sint_maarten">Sint Maarten</option>
	<option value="slovakia">Slovakia</option>
	<option value="slovenia">Slovenia</option>
	<option value="solomon_islands">Solomon Islands</option>
	<option value="somalia">Somalia</option>
	<option value="south_africa">South Africa</option>
	<option value="south_georgia_and_the_south_sandwich_islands">South Georgia and the South Sandwich Islands</option>
	<option value="south_sudan">South Sudan</option>
	<option value="spain_">Spain </option>
	<option value="spratly_islands">Spratly Islands</option>
	<option value="sri_lanka">Sri Lanka</option>
	<option value="sudan">Sudan</option>
	<option value="suriname_">Suriname </option>
	<option value="svalbard">Svalbard</option>
	<option value="swaziland">Swaziland</option>
	<option value="sweden">Sweden</option>
	<option value="switzerland">Switzerland</option>
	<option value="syria">Syria</option>
	<option value="taiwan">Taiwan</option>
	<option value="tajikistan">Tajikistan</option>
	<option value="tanzania">Tanzania</option>
	<option value="thailand">Thailand</option>
	<option value="timor-leste">Timor-Leste</option>
	<option value="togo">Togo</option>
	<option value="tokelau">Tokelau</option>
	<option value="tonga">Tonga</option>
	<option value="trinidad_and_tobago">Trinidad and Tobago</option>
	<option value="tunisia">Tunisia</option>
	<option value="turkey">Turkey</option>
	<option value="turkmenistan">Turkmenistan</option>
	<option value="turks_and_caicos_islands">Turks and Caicos Islands</option>
	<option value="tuvalu">Tuvalu</option>
	<option value="uganda">Uganda</option>
	<option value="ukraine">Ukraine</option>
	<option value="united_arab_emirates">United Arab Emirates</option>
	<option value="united_kingdom">United Kingdom</option>
	<option value="united_states">United States</option>
	<option value="uruguay">Uruguay</option>
	<option value="uzbekistan">Uzbekistan</option>
	<option value="vanuatu">Vanuatu</option>
	<option value="venezuela">Venezuela</option>
	<option value="vietnam">Vietnam</option>
	<option value="virgin_islands,_british">Virgin Islands, British</option>
	<option value="virgin_islands,_u.s.">Virgin Islands, U.S.</option>
	<option value="wake_island">Wake Island</option>
	<option value="wales">Wales</option>
	<option value="wallis_and_futuna">Wallis and Futuna</option>
	<option value="western_sahara">Western Sahara</option>
	<option value="yemen">Yemen</option>
	<option value="zambia">Zambia</option>
	<option value="zimbabwe">Zimbabwe</option>
</select>
<label for='country' >Selected Flag:</label>
   </div>

   <div class='flags-container other'>
               <input type='text' placeholder="Other, please specify" name='other' id='other' maxlength="50" />
               <label for='other' >Other:</label>
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
