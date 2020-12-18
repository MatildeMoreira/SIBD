<!-- This page performs the edition or addition of consultation details
provided by a form in another page -->

<?php
	session_start();
?>

<html>
	<head>
		<title> Dental Clinic - Group 42</title>
		<style>
			/*background and button styling*/
			td.hidden {
  				visibility: hidden;
  			}
			body {
				background-image: url('teeth.jpg');
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: cover;
				justify-content: center;
			}
			.button {
				background-color: #4CAF50; /* Green */
				border: none;
				color: white;
				padding: 16px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				-webkit-transition-duration: 0.4s; /* Safari */
				transition-duration: 0.4s;
				cursor: pointer;
				box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
				border-radius: 12px;
				width: 300px;
			}

			.button1 {
				background-color: white; 
				color: black; 
				border: 2px solid #4CAF50;
			}

			.button1:hover {
				background-color: #4CAF50;
				color: white;
			}

			.button2 {
				background-color: white; 
				color: black; 
				border: 2px solid #008CBA;
			}

			.button2:hover {
				background-color: #008CBA;
				color: white;
			}

			.button3 {
			background-color: white; 
			color: black; 
			border: 2px solid #f44336;
			}

			.button3:hover {
			background-color: #f44336;
			color: white;
			}
			.button4 {
			background-color: white;
			color: black;
			border: 2px solid #555555;
			}

			.button4:hover {background-color: #555555;}
  		</style>
  	</head>
	<body>

		<b><h1 style="text-align:center;">Addition results:</h1><b>
		<?php
			/*definition of variables to connect to DB*/
			$host = "db.tecnico.ulisboa.pt";
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$dsn = "mysql:host=$host;dbname=$user";

			// Try to connect into a database
			try {
				$connection = new PDO($dsn, $user, $pass);
			} catch(PDOException $exception) {
				echo("<p>Error: ");
				echo($exception->getMessage());
				echo("</p>");
				exit();
			}
			/*fetching of variables posted to this page by a form*/
			$n_nurses = $_REQUEST['n_nurses'];
			$n_diagnostics = $_REQUEST['n_diagnostics'];
			$n_pres = $_REQUEST['n_pres'];
			$VAT_doctor = $_REQUEST['VAT_doctor'];
			$date_timestamp = $_REQUEST['date_timestamp'];
			$SOAP_S = $_REQUEST['SOAP_S'];
			$SOAP_O = $_REQUEST['SOAP_O'];
			$SOAP_A = $_REQUEST['SOAP_A'];
			$SOAP_P = $_REQUEST['SOAP_P'];

			#########################SOAP notes#########################################
			/* sql instruction to update the soap notes of this consultations */
			$sql = "UPDATE consultation 
					SET VAT_doctor = '$VAT_doctor', date_timestamp = '$date_timestamp', SOAP_S = '$SOAP_S', SOAP_O = '$SOAP_O', SOAP_A = '$SOAP_A', SOAP_P = '$SOAP_P'
					WHERE VAT_doctor = '$VAT_doctor'
					AND timestampdiff(HOUR, '$date_timestamp', date_timestamp) = 0";
		
			$result = $connection->exec($sql);
			if ($result == 0)
			{
				echo('<p>Error ocurred adding SOAP notes!</p>');
			}
			else{
				echo('<p>Success adding SOAP notes!</p>');
			}

			############################nurses###############################

			/* check if nurse fields were filled and adds nurse for each field filled */
			for($i = 0; $i < $n_nurses; $i++){
				$key = "nurse$i";
				if(isset($_REQUEST[$key]) && strlen(trim($_REQUEST[$key])) > 0){
					$VAT_nurse = $_REQUEST[$key];

					$sql = "INSERT INTO consultation_assistant VALUES 
					('$VAT_doctor','$date_timestamp','$VAT_nurse')";

					$result = $connection->query($sql) or die(mysql_error());
					if ($result == 0)
					{
						echo('<p>Error ocurred adding nurses!</p>');
					}
					else{
						echo('<p>Success adding nurses!</p>');
					}
				}
			}

			############################diagnostics###############################

			/* check if diagnostic fields were filled and adds diagnostic for each field filled */
			for($i = 0; $i < $n_diagnostics; $i++){
				$key = "diagnostic$i";
				if(isset($_REQUEST[$key]) && strlen(trim($_REQUEST[$key])) > 0){
					$diagnostic_ID = $_REQUEST[$key];

					$sql = "INSERT INTO consultation_diagnostic VALUES 
					('$VAT_doctor','$date_timestamp','$diagnostic_ID')";

					$result = $connection->query($sql) or die(mysql_error());
					if ($result == 0)
					{
						echo('<p>Error ocurred adding diagnostics!</p>');
					}
					else{
						echo('<p>Success adding diagnostics!</p>');
					}
				}
			}

			############################prescriptions###############################

			/* check if prescription fields were filled and adds prescription
			 for each set of fields filled */
			for($i = 0; $i < $n_pres; $i++){
				$ml_key = "med_lab$i";
				$d_key = "dosage$i";
				$r_key = "regime$i";
				if(isset($_REQUEST[$ml_key]) && strlen(trim($_REQUEST[$ml_key])) > 0){
					$raw = $_REQUEST[$ml_key];
					$info = explode("?",$raw,3);
					$med = $info[0];
					$lab = $info[1];
					$id = $info[2];
					if(isset($_REQUEST[$d_key]) && strlen(trim($_REQUEST[$d_key])) > 0){
						$dosage = $_REQUEST[$d_key];
						if(isset($_REQUEST[$d_key]) && strlen(trim($_REQUEST[$d_key])) > 0){
							$regime = $_REQUEST[$r_key];
							$sql = "INSERT INTO prescription VALUES 
								('$med','$lab','$VAT_doctor','$date_timestamp','$id','$dosage','$regime')";
							$result = $connection->query($sql) or die(mysql_error());
							if ($result == 0)
							{
								echo('<p>Error ocurred adding prescriptions!</p>');
							}
							else{
								echo('<p>Success adding prescriptions!</p>');
							}
						}
					}
				}
			}

			$connection = null;

			echo("<form action='appdetailshow.php' method='post'>");
			echo("<input type='hidden' name='type[info]' value='$VAT_doctor?$date_timestamp?Y'>");
			echo("<button class='button button1' type='submit'>Back to Appointment Details</button>");
			echo("</form>");
		?>	 

		<p></p>
		<form action="clientsearchform.php" method="post">
			<button class="button button3" type="submit">Client Search</button>
		</form>
		
		<form action="index.php" method="post">
			<button class="button button2" type="submit">Back to the main page</button>
		</form>	
	</body>
</html>