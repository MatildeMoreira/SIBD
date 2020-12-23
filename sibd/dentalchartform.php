<!-- This page is a form. It asks the user for input about the
the dental charting that is to be inserted in the DB -->

<?php
	session_start();
?>
<html>
<head>
	<title> Dental Clinic - Group 42</title>
</head>
<style>
	/*background and button styling*/
	body {
		background-image: url('dental_registration.jpg');
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
		justify-content: center;
	}
	.cleanForm {
		width: 550px;
	}

	fieldset > label > input {
		display: block;
	}
	input[type="checkbox"] {
		display: inline;
	}
	label {
		margin: 10px;
		padding: 5px;
	}
	fieldset > label {
		float: left;
		width: 200px;
	}
	label:nth-child(2n+1) {
		clear: both;
	}
	#gender, .tos, button {
		clear: both;
	}
	.tos {
		width: 400px;
	}
	input[type='text']{
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;

		-webkit-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);
		-moz-box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);
		box-shadow: inset 2px 2px 3px rgba(0, 0, 0, 0.2);

		padding: 5px;
	}
	.button {
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
		width: 550px;
	}
	.button1 {
		background-color: white; 
		color: black; 
		border: 2px solid #008CBA;
	}

	.button1:hover {
		background-color: #008CBA;
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
<body>
	<b><h1 style="text-align:center;">Dental Charting</h1></b>
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
		$VAT_doctor = $_REQUEST['VAT_doctor'];
		$date_timestamp = $_REQUEST['date_timestamp'];

		/* selection of dental charting associated to this consultation */
		/* if any exist, then it's not possible to add another */
		$sql = "SELECT * FROM procedure_in_consultation as pc 
				WHERE pc.VAT_doctor = '$VAT_doctor'
				AND timestampdiff(HOUR, '$date_timestamp', pc.date_timestamp) = 0
				AND pc.name_procedure = 'Dental charting'";

		$result = $connection->query($sql) or die(mysql_error());
		if ($result == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>");
			exit();
		}

		if($result->rowCount() == 0)
		{
			/* if no dental charting is associated to this consultations, it is possible to add one */
			echo("<h3 style='text-align:center;'>Insert the tooth-gum gaps values in the form below</h3>");

			/* selection of all teeth and their values */
			$sql = "SELECT * FROM teeth";
	
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}
			if ($result->rowCount() > 0)
			{
				/* if teeth are found... */
				echo("<form name='dentalchartform' action='dentalchart.php' method='post'>");
			
					echo("Enter procedure observations or outcomes<br>");
					echo("<input type='text' name='description_procedure' id='description_procedure' placeholder='Observations' size='90' maxlength='70'>");

					echo("<fieldset>");

					echo("<p>Record the <b>measurements</b> and <b>observtions</b> on each tooth:</p>");
					$tooth_count = 0;
					foreach($result as $row){
						/* for each tooth, stores its values in an array */
						$tooth[$tooth_count][0] = $row['quadrant'];
						$tooth[$tooth_count][1] = $row['number_teeth'];
						$tooth[$tooth_count][2] = $row['name_teeth'];
						$tooth_count++;
					}
					for($i = 0; $i < $tooth_count; $i++){
						/* for each tooth, generates fields to add measurements and comments*/
						$quadrant = $tooth[$i][0];
						$number = $tooth[$i][1];
						$name = $tooth[$i][2];
						echo("<p><b>$name ($quadrant-$number):&nbsp</b><input type='number' min='0' max='100' name='meas$i' id='meas$i' value='0'>");
						echo("&nbsp&nbsp<input type='text' name='description_meas$i' id='description_meas$i' value='' placeholder='Commentary' size='50' maxlength='40'></p>");
						echo("<input type='hidden' name='number$i' id='number$i' value='$number'>");
						echo("<input type='hidden' name='quadrant$i' id='quadrant$i' value='$quadrant'>");
					}
					echo("</fieldset>");

					echo("<input type='hidden' name='VAT_doctor' id='VAT_doctor' value='$VAT_doctor'>");
					echo("<input type='hidden' name='date_timestamp' id='date_timestamp' value='$date_timestamp'>");
					echo("<input type='hidden' name='tooth_count' id='tooth_count' value='$tooth_count'>");
					echo("<input type='hidden' name='all' value='0'>");
					echo("<button class='button button1' value='Submit' type='button' onclick='checkforempty($tooth_count)'>Submit</button>");
					
				echo("</form>");
			}
			else{
				/* error message if teeth table has no rows*/
				echo("<p>You have not populated the table <b>teeth</b>!</p>");
			}
		}
		else{
			/* Message if dental charting is already associated to this consultation*/
			echo("<p>A dental charting was already recorded in this consultation. You cannot add another.</p>");
			/* selects the rows of procedure_charting that correspond to this consultation */
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
				/* table of procedure_charting that corresponds to this consultation */
				echo("<h1 style='text-align:center;'>Table of existing <em>dental charting</em></h1>");
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
	<script>
		/* script checks for empty fields and outputs error messages they are detected */
		function checkforempty(count) {
			var aux1, aux2;
			var key;
			var check;
			check = 0;
			if(document.getElementById('description_procedure').value == ''){
				alert('You must add general comment on procedure!');
				return false;
			}
			for(j = 0; j < count; j++){
		    	key = j.toString();
		    	key = 'meas' + key;
				aux1 = document.getElementById(key).value;
				key = j.toString();
	    		key = 'description_meas' + key;
				aux2 = document.getElementById(key).value;
				if(aux1 != '0'){					
					if(aux2 == ''){
						alert('You added measurement to a tooth but forgot to add comment!');
						return false;
					}
					check = 1;
				}
				else{
					if(aux2 != ''){
						alert('You added comment to a tooth but forgot to add measurement!');
						return false;
					}
				}
			}
			if(check == 1){
				dentalchartform.submit();
			}
			else{
				alert('You need to fill the fields for at least one tooth!');
				return false;
			}		
		}
  </script>
</body>
</html>