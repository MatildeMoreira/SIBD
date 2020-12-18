<!-- This page processes the info of the form of dental charting insertions and performs its insertion in the DB -->

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

		<b><h1 style="text-align:center;">Addition results:</h1></b>
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
			$description_procedure = $_REQUEST['description_procedure'];
			$tooth_count = $_REQUEST['tooth_count'];
			$VAT_doctor = $_REQUEST['VAT_doctor'];
			$date_timestamp = $_REQUEST['date_timestamp'];

			/* insertion of dental charting procedure in the tables of procedures in consultation */
			$sql = "INSERT INTO procedure_in_consultation VALUES 
					('Dental charting','$VAT_doctor','$date_timestamp','$description_procedure')";
		
			$result = $connection->exec($sql);
			if ($result == 0)
			{
				/* error message if insertion failed*/
				echo('<p>Error ocurred adding procedure!</p>');
			}
			else{
				/* this portion of code only runs if the insertion in procedure in consultation was
				successfull, like this DB consistency is maintained*/
				/* transaction begins */
				$connection->beginTransaction();

				/* check variables that count how many rows are to be inserted and how many of those
				were really inserted */
				$transaction = 0;
				$results = 0;

				/* cycle for row insertion in procedure_charting table */
				for($i = 0; $i < $tooth_count; $i++){
					$key = "meas$i";
					if(isset($_REQUEST[$key]) && trim($_REQUEST[$key]) != '0'){
						$meas = $_REQUEST[$key];
						$key = "description_meas$i";
						$description_meas = $_REQUEST[$key];
						$key = "number$i";
						$number = $_REQUEST[$key];
						$key = "quadrant$i";
						$quadrant = $_REQUEST[$key];

						$sql = "INSERT INTO procedure_charting VALUES 
						('Dental charting','$VAT_doctor','$date_timestamp','$quadrant','$number','$description_meas','$meas')";

						$result = $connection->exec($sql);
						$transaction++;
						$results += $result;
					}
				}
				if($transaction == $results){
					/* if the number of rows to be inserted matches the number of rows inserted
					then the commits */
					$connection->commit();
				}
				else{
					/* if not, rolls back and outputs error message*/
					$connection->rollBack();
					echo('<p>Error ocurred adding dental charting!</p>');
				}

				/* selects the rows of procedure_charting that were inserted in the transaction */
				$sql = "SELECT * FROM procedure_charting as pc
						WHERE pc.VAT = '$VAT_doctor'
						AND timestampdiff(HOUR, '$date_timestamp', pc.date_timestamp) = 0
						AND pc.name_procedure = 'Dental charting'";

				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				if($result->rowCount() > 0){
					/* table of rows of procedure_charting that were inserted in the transaction */
					echo("<h1 style='text-align:center;'>Table of added <em>dental charting</em></h1>");
					echo("<table align='center' border=\"1\">");
					echo("<tr>");
					echo("<td><b>Procedure</b></td>");
					echo("<td><b>VAT_doctor</b></td>");
					echo("<td><b>Date and time</b></td>");
					echo("<td><b>Tooth quadrant</b></td>");
					echo("<td><b>Tooth number</b></td>");
					echo("<td><b>Comment</b></td>");
					echo("<td><b>Tooth-gum gap</b></td>");
					echo("</tr>");
					foreach($result as $row)
					{
						echo("<tr><td>");
						echo($row['name_procedure']);
						echo("</td><td>");
						echo($row['VAT']);
						echo("</td><td>");
						echo($row['date_timestamp']);
						echo("</td><td>");
						echo($row['quadrant']);
						echo("</td><td>");
						echo($row['number_teeth']);
						echo("</td><td>");
						echo($row['_desc']);
						echo("</td><td>");
						echo($row['measure']);
						echo("</td></tr>");
					}
					echo("</table>");
				}
			}

			echo("<form action='appdetailshow.php' method='post'>");
				echo("<input type='hidden' name='type[info]' value='$VAT_doctor?$date_timestamp?Y'>");
				echo("<button class='button button2' type='submit'>Back to Information about Consultation</button>");
			echo("</form>");
		?>
		<form action='index.php' method='post'>
			<input type='hidden' name='all' value='1'>
			<button class='button button3' type='submit'/>Back to the main page</button>
		</form>
	</body>
</html>
