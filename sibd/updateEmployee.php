<!-- This is the page that processes the information for
updating the informatino of an existing employee in the DB -->
<?php
	session_start();
?>
<html>
    <title> Dental Clinic - Group 42</title>
	<style>
        /* button and background styling */
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
            $VAT_Employee = $_REQUEST['VAT_Employee'];
            $Employee_Name = $_REQUEST['Employee_Name'];
            echo("<h3 style='text-align:center;'>Employee VAT: ${VAT_Employee}</h3>");
            echo("<h3 style='text-align:center;'>Employee Name: ${Employee_Name}</h3>");

            $birth_date = $_REQUEST['birth_date'];
            $birth_dateRes = 0;
            $street = $_REQUEST['street'];
            $streetRes = 0;
            $city = $_REQUEST['city'];
            $cityRes = 0;
            $zip = $_REQUEST['zip'];
            $zipRes = 0;
            $IBAN = $_REQUEST['IBAN'];
            $IbanRes = 0; 
            $phone = $_REQUEST['phone'];
            $phoneRes = 0;
            $salary = $_REQUEST['salary'];
            $salaryRes = 0;
            //echo("<p>VAT: ".$VAT_Employee."Name: ".$Employee_Name."Birth Date: ".$birth_date."Street: ".$street."City: ".$city."Zip: ".$zip."IBAN: ".$IBAN."Salary: ".$salary."</p>");
            
            /* update information of emmployee depending on what the user filled in the form */
            if ($birth_date != ''){
                $birth_dateQuery = "UPDATE employee SET birth_date = '$birth_date' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $birth_dateRes=$connection->exec($birth_dateQuery);
            }
            if ($street != ''){
                $streetQuery = "UPDATE employee SET street = '$street' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $streetRes=$connection->exec($streetQuery);
            }
            if($city != ''){
                $cityQuery = "UPDATE employee SET city = '$city' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $cityRes=$connection->exec($cityQuery);   
            }
            if($zip != ''){
                $zipQuery = "UPDATE employee SET zip = '$zip' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $zipRes=$connection->exec($zipQuery);
            }
            if($IBAN != ''){
                $ibanQuery = "UPDATE employee SET IBAN = '$IBAN' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $IbanRes=$connection->exec($ibanQuery);
            }
            if($salary != ''){
                $salaryQuery = "UPDATE employee SET salary = '$salary' WHERE employee_name = '$Employee_Name' AND VAT = '$VAT_Employee' ";
                $zipRes=$connection->exec($salaryQuery);
            }

            if($phone != ''){
                $phoneQuery = "UPDATE phone_number_employee SET phone = '$phone' WHERE VAT = '$VAT_Client' ";
                $phoneRes=$connection->exec($phoneQuery);
            }
   

            if ($birth_dateRes == 1 || $streetRes == 1 || $cityRes == 1 || $zipRes == 1 || $salaryRes == 1 || $IbanRes == 1 || $phoneRes == 1 || $ageRes == 1){
                /* shows success message on update of at least one field */
				echo("<h1 style='text-align:center;'>SUCCESS!</h1>");
				echo("<h3 style='text-align:center;'> Informations of Employee ${Employee_Name} updated!</h3>");
            }
            else{
                /* shows failure message when none of the fields was updated successfully */
				echo("<h1 style='text-align:center;'>FAILURE!</h1>");
				echo("<h3 style='text-align:center;'>The employee already found, but no information updated!</h3>");
                echo("<form action='updateEmployeeform.php' method='post'>");
                echo("<input type='hidden' name='type[info]' value='$Employee_Name:$VAT_Employee'>");
                echo("<button class='button button3' type='submit'>Try again</button>");
                echo("</form>");
            }

        ?>
		<p>
		<form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button align='middle' class="button button2" type="submit"/>Back to the main page</button>
		</form>
		</p>

    </body>
</html>