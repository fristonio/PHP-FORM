<html>
	<head>
		<link rel="stylesheet" href="styleform.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	</head>
	<body>
		<div class="myform">
		<?php
			$SeeError=0;
			$host='localhost';
			$user='guest';
			$pass='guest123';
			function format($data) {
  				$data = trim($data);
  				$data = stripslashes($data);
  				$data = htmlspecialchars($data);
  				return $data;
			}
			$name=$email=$website=$mobile=$abtyou=$interest=$college=$abtclg='';
			$nameErr=$emailErr=$websiteErr=$mobileErr=$abtyouErr=$interestErr=$collegeErr=$abtclgErr='';
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				if(empty($_POST["name"])){
					$nameErr="* The name field is required";
					$SeeError=1;
				}
				else{
					$name=format($_POST["name"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  						$nameErr = "Entered name is not a valid name";
  						$SeeError=1;
  					}
				}

				if(empty($_POST["email"])){
					$emailErr="* The EMAIL field is necessery";
					$SeeError=1;
				}
				else{
					$email=format($_POST["email"]);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  						$emailErr = "Email provided is not a valid email"; 
  						$SeeError=1;
					}
				}

				if(empty($_POST["mobile"])){
					$mobileErr="* The MOBILE NAME field is required";
					$SeeError=1;
				}
				else
					$mobile=format($_POST["mobile"]);

				if(empty($_POST["url"])){
					$websiteErr="* The WEBSITE is required";
					$SeeError=1;
				}
				else{
					$website=format($_POST["url"]);
					if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
  						$websiteErr = "Invalid URL"; 
  						$SeeError=1;
					}
				}

				$abtyou=format($_POST["abtyou"]);

				if(empty($_POST["interest"])){
					$interestErr="* The INTEREST is required";
					$SeeError=1;
				}
				else
					$interest=format($_POST["interest"]);

				if(empty($_POST["college"])){
					$collegeErr="* The COLLEGE IS required";
					$SeeError=1;
				}
				else{
					$college=format($_POST["college"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  						$nameErr = "Entered name is not a valid name";
  						$SeeError=1;
  					}
				}

				$abtclg=format($_POST["abtclg"]);
			if($SeeError===0){
			$conn = mysql_connect($host, $user, $pass);
			if(! $conn ){
  				die('Could not connect: ' . mysql_error());
			}
			else{
				$sql="INSERT INTO USERS( Name,Email,Website,Mobile,AbtYou,Interests,College,AbtClg)
					 VALUES
					 ('$name','$email','$website','$mobile','$abtyou','$interest','$college','$abtclg')";
				mysql_select_db('FirstDatabse');
				$retval = mysql_query($sql,$conn);
				if(! $retval ){
  						die('Could not enter data: ' . mysql_error());
				}
				$message = "Data entered have been Saved in the DATABASE";
				echo "<script type='text/javascript'>alert('$message');</script>";
				mysql_close($conn);
			}
			}

			}
		?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<fieldset>
<legend><span class="number">1</span> BASIC Info</legend>

NAME :<p class="error"> <span class="error"><?php echo $nameErr; ?></span></p>

<input type="text" name="name" placeholder="Your Name *" value="<?php echo $name; ?>" required>

E-MAIL : <p class="error"><span class="error"><?php echo $emailErr; ?></span></p>

<input type="email" name="email" placeholder="Your Email *" value="<?php echo $email; ?>" required>

WEBSITE : <p class="error"><span class="error"><?php echo $websiteErr ?></span></p>

<input type="url" name="url" placeholder="Your Website *" value="<?php echo $website; ?>">

MOBILE : <p class="error"><span class="error"><?php echo $mobileErr ?></span></p>

<input type="number" name="mobile" placeholder="Your Mobile *" value="<?php echo $mobile; ?>">

ABOUT :
<textarea name="abtyou" placeholder="About yourself" value="<?php  echo $abtyou; ?>" rows="4"></textarea>

<label for="job">Interests:</label><p class="error"><span class="error"><?php echo $interestErr ?></span></p>
<select id="job" name="interest" value="Boxing">
<optgroup label="Indoors">
  <option value="reading">Reading</option>
  <option value="boxing">Boxing</option>
  <option value="debate">Debate</option>
  <option value="gaming">Gaming</option>
  <option value="snooker">Snooker</option>
  <option value="other_indoor">Other</option>
</optgroup>
<optgroup label="Outdoors">
  <option value="football">Football</option>
  <option value="swimming">Swimming</option>
  <option value="fishing">Fishing</option>
  <option value="climbing">Climbing</option>
  <option value="cycling">Cycling</option>
  <option value="other_outdoor">Other</option>
</optgroup>
</select>      
</fieldset>
<fieldset>
<legend><span class="number">2</span> Additional Info</legend>
COLLEGE :<p class="error"><span class="error"><?php echo $collegeErr ?></span></p>
<input type="text" name="college" placeholder="College *" value="<?php echo $college; ?>">
ABOUT COLLEGE :
<textarea name="abtclg" placeholder="About Your College" value="<?php echo $abtclg; ?>"></textarea>
</fieldset>
<input type="submit" value="Apply"/>
<input type="reset" value="RESET">
<div class="cleardiv"></div>
</form>
</div>
	</body>
</html>