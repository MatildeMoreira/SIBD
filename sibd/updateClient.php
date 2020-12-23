<!-- This is the page that processes the information for
updating the informatino of an existing client in the DB -->
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
            $VAT_Client = $_REQUEST['VAT_Client'];
            $Client_Name = $_REQUEST['Client_Name'];
            echo("<h3 style='text-align:center;'>Client VAT: ${VAT_Client}</h3>");
            echo("<h3 style='text-align:center;'>Client Name: ${Client_Name}</h3>");

            $birth_date = $_REQUEST['birth_date'];
            $birth_dateRes = 0;
            $street = $_REQUEST['street'];
            $streetRes = 0;
            $city = $_REQUEST['city'];
            $cityRes = 0;
            $zip = $_REQUEST['zip'];
            $zipRes = 0;
            $sex = $_REQUEST['gender'];
            $sexRes = 0; 
            $phone = $_REQUEST['phone'];
            $phoneRes = 0;
            $ageRes = 0;
            //echo("<p>VAT: ".$VAT_Client."Name: ".$Client_Name."Birth Date: ".$birth_date."Street: ".$street."City: ".$city."Zip: ".$zip."Gender: ".$sex."</p>");
            
            /* update information of client depending on what the user filled in the form */
            if ($birth_date != ''){
                $birth_dateQuery = "UPDATE client SET birth_date = '$birth_date' WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $birth_dateRes=$connection->exec($birth_dateQuery);
                $ageQuery = "UPDATE client SET age = timestampdiff(YEAR, birth_date, NOW()) WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $ageRes=$connection->exec($ageQuery);
            }
            if ($street != ''){
                $streetQuery = "UPDATE client SET street = '$street' WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $streetRes=$connection->exec($streetQuery);
            }
            if($city != ''){
                $cityQuery = "UPDATE client SET city = '$city' WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $cityRes=$connection->exec($cityQuery);   
            }
            if($zip != ''){
                $zipQuery = "UPDATE client SET zip = '$zip' WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $zipRes=$connection->exec($zipQuery);
            }
            if($sex != ''){
                $sexQuery = "UPDATE client SET gender = '$sex' WHERE client_name = '$Client_Name' AND VAT = '$VAT_Client' ";
                $sexRes=$connection->exec($sexQuery);
            }

            if($phone != ''){
                $phoneQuery = "UPDATE phone_number_client SET phone = '$phone' WHERE VAT = '$VAT_Client' ";
                $phoneRes=$connection->exec($phoneQuery);
            }
   

            if ($birth_dateRes == 1 || $streetRes == 1 || $cityRes == 1 || $zipRes == 1 || $sexRes == 1 || $phoneRes == 1 || $ageRes == 1){
                /* shows success message on update of at least one field */
				echo("<h1 style='text-align:center;'>SUCCESS!</h1>");
				echo("<h3 style='text-align:center;'> Informations of Client ${Client_Name} updated!</h3>");
            }
            else{
                /* shows failure message when none of the fields was updated successfully */
				echo("<h1 style='text-align:center;'>FAILURE!</h1>");
				echo("<h3 style='text-align:center;'>The client already found, but no information updated!</h3>");

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