<html>
	<head>
		<link rel="stylesheet" href="styleform.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>
	<body>
		<div class="myform" style="margin: auto;">

			<?php 
				$username=$password='';
				$userErr=$passErr='';
				$SeeError=0;
				$match=0;
				$host='localhost';
				$user='guest';
				$pass='guest123';

				function format($data) {
  					$data = trim($data);
  					$data = stripslashes($data);
  					$data = htmlspecialchars($data);
  					return $data;
				}

				if ($_SERVER["REQUEST_METHOD"] == "POST"){
					if(empty($_POST["user"])){
						$userErr="* The Username field is required";
						$SeeError=1;
					}
				else{
					$username=format($_POST["user"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
  						$userErr = "Entered USERNAME is not a valid username";
  						$SeeError=1;
  					}
				}
				if(empty($_POST["pass"])){
					$userErr="* The Password field cannot be empty";
					$SeeError=1;
				}
				else{
					$password=format($_POST["pass"]);
				}

				if($SeeError===0){
					$conn = mysql_connect($host, $user, $pass);
					if(! $conn ){
  						die('Could not connect: ' . mysql_error());
					}
					else{
						mysql_select_db('FirstDatabse');
						$sql="SELECT Name,Mobile FROM USERS";
						$retval = mysql_query($sql,$conn);
						if(! $retval ){
  							die('Could not enter data: ' . mysql_error());
						}
						while($row = mysql_fetch_array($retval,MYSQL_ASSOC)){
							if(($row['Name']==$username) && ($row['Mobile']==$password)){
								echo "<script type='text/javascript'>alert('SUCESSFULLY LOGGED IN');</script>";
								$username=$password='';
								$match=1;
							}
						}
						if($match===0){
							echo "<script type='text/javascript'>alert('SORRY BITCH !!!! WRONG PASSWORD');</script>";
							$username=$password='';
						}
					}
					mysql_close($conn);
				}
			}

			 ?>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<fieldset>
			<legend><span class="number">LP</span> LOGIN PAGE </legend>
			UserName : <p class="error"> <span class="error"><?php echo $userErr; ?></span></p>
			<input type="text" name="user" placeholder="USERNAME *" value="<?php echo $username; ?>" required>

			PASSWORD :<p class="error"> <span class="error"><?php echo $passErr; ?></span></p>
			<input type="text" name="pass" placeholder="PASSWORD *" value="<?php echo $password; ?>" required>

			<input type="submit" value="Login">
			<input type="reset" value="RESET">
			<div class="cleardiv"></div>
			</fieldset>
			</form>
		</div>
	</body>
</html>