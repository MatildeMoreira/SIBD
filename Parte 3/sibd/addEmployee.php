<!-- This is the page that processes the information to add a new employee
 and performs the INSERT into the DB -->
<?php
<?php
	session_start();
?>
<html>
	<title> Dental Clinic - Group 42</title>
	<style>
			/*background and button styling*/
			td.hidden {
  				visibility: hidden;
  			}
			body {
				background-image: url('teeth_dental.care.jpg');
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
	</style>
	<body>
		<?php

			/*definition of variables to connect to DB*/
			$host = "db.tecnico.ulisboa.pt";
			$user = $_SESSION['user'];
			$pass = $_SESSION['pass'];
			$dsn = "mysql:host=$host;dbname=$user";
			try {
				$connection = new PDO($dsn, $user, $pass);
			} catch(PDOException $exception) {
				echo("<p>Error: ");
				echo($exception->getMessage());
				echo("</p>");
				exit();
			}
			
			/*fetching of variables posted to this page by a form*/
			$VAT = $_REQUEST['VAT'];
			$name = $_REQUEST['name'];
			$birth_date = $_REQUEST['birth_date'];
			$street = $_REQUEST['street'];
			$city = $_REQUEST['city'];
			$zip = $_REQUEST['zip'];
            $salary = $_REQUEST['salary'];
            $IBAN = $_REQUEST['IBAN'];
			$phone = $_REQUEST['phone'];
			$job = $_REQUEST['jobposition'];
			$specialization="";
			$biography="";
			$Email="";
			$TypeDoctor="";
			$VAT_Supervisor="";
			$NumYears="";
			$result2 = 0;

			/*insertion of new employee in the DB*/
			$sql = "INSERT INTO employee VALUES ('$VAT','$name','$birth_date','$street','$city','$zip','$IBAN','$salary')";
			$result = $connection->exec($sql);
			echo("<p>VAT: ".$VAT."Name: ".$name."Birth Date: ".$birth_date."Street: ".$street."City: ".$city."Zip: ".$zip."Salary: ".$salary."</p>");
			
			if (($phone != null) && ($result != null)){
				/*insertion of the phone number of new employee if provided DB*/
				$sql2 = "INSERT INTO phone_number_employee VALUES ('$VAT','$phone')";
				$result2 = $connection->exec($sql2);					
			}
			
			if($job == 'receptionist'){
				echo("I'm a receptionist: $job");
				/*insertion of new receptionist if that's the case*/
				$sql3_receptionist = "INSERT INTO receptionist VALUES ('$VAT')";
				$result3 = $connection->exec($sql3_receptionist);
			}
			else if ($job == 'nurse'){
				/*insertion of new nurse if that's the case*/
				echo("I'm a nurse: $job");
				$sql4_nurse = "INSERT INTO nurse VALUES ('$VAT')";
				$result4 = $connection->exec($sql4_nurse);
			}
			else if($job == 'doctor'){
				/*insertion of new doctor if that's the case*/
				echo("I'm a doctor: $job");
				$specialization = $_REQUEST['specialization'];
				$biography = $_REQUEST['biography'];
				$Email= $_REQUEST['email'];
				$sql5_doctor = "INSERT INTO doctor VALUES ('$VAT','$specialization','$biography','$Email')";
				$result5 = $connection->exec($sql5_doctor);
				$TypeDoctor= $_REQUEST['typeDoctor'];

				if($TypeDoctor == 'traineeDoctor'){
					/*insertion of new trainee doctor if that's the case*/
					echo("I'm a trainee doctor: $TypeDoctor");
					$VAT_Supervisor = $_REQUEST['VAT_PermDoct'];
					$sql6_trainee = "INSERT INTO trainee_doctor VALUES ('$VAT','$VAT_Supervisor')";
					$result6 = $connection->exec($sql6_trainee);
	
				}
				else if ($TypeDoctor == 'permanentDoctor'){
					/*insertion of new permanent doctor if that's the case*/
					echo("I'm a permanent doctor: $TypeDoctor");
					$NumYears = $_REQUEST['numYears'];
					$sql7_permanent = "INSERT INTO permanent_doctor VALUES ('$VAT','$NumYears')";
					$result7 = $connection->exec($sql7_permanent);			
				}
			}
			echo("<p>Resultado: ".$result. "Resultado2: ".$result2. "Resultado3: ".$result3."Resultado4: ".$result4."</p>");
			echo("<p>Resultado5: ".$result5. "Resultado6: ".$result6. "Resultado7: ".$result7. "</p>");

			echo("<p>'VAT:".$VAT."PhoneNumber:".$phone."</p>");

			if($result == 1 && ($result3 == 1 || $result4 == 1 || ($result5 == 1 && ($result6 == 1 || $result7 == 1)))){
				/*if the the insertion of employee + job succeeds, shows success message*/
				echo("<h1 style='text-align:center;'>SUCCESS!</h1>");
				echo("<h3 style='text-align:center;'> Now you can search at Employees List!</h3>");
    		}
			else {
				/*if the the insertion of employee + job fails, shows failure message*/
				echo("<h1 style='text-align:center;'>FAILURE!</h1>");
				echo("<h3 style='text-align:center;'>The employee already exists with the VAT!</h3>");
				if($result2 == 1){
					/*if the the insertion of employee + job fails and phone insertion succeeds
					it removes the inserted phone as this behaviour is not expected from a page that
					adds employees*/
					echo("<h4 style='text-align:center;'>Inserted a new Mobile phone!</h3>");
					$deletePhone="DELETE FROM phone_number_employee WHERE VAT='$VAT' AND phone='$phone";
					$resDelPhone = $connection->exec($deletePhone);
				}

				/*if the the insertion of employee succeeds but the insertion of job fails
				it removes the inserted employee because every employee has to be either doctor, nurse or
				receptionist*/
				$deleteEmployee="DELETE FROM employee WHERE VAT='$VAT' AND employee_name='$name' AND birth_date='$birth_date' AND
								street='$street' AND city='$city' AND zip='$zip' AND IBAN='$IBAN' AND salary='$salary'";
				$resDelEmployee = $connection->exec($deleteEmployee);
				echo("<form action='addEmployeeform.php' method='post'>");
				echo("<button class='button button3' type='submit'>Try Again</button>");
				echo("</form>");
			}
		?>
		<p>
		<form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button class="button button2" type="submit"/>Back to the main page</button>
		</form>
		</p>
	</body>
</html>
