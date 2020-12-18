<!-- This page is a form. It asks the user for input about the
the details of the consultation that is to be inserted in the DB -->
<?php
	session_start();
?>
<html>
	<title> Dental Clinic - Group 42</title>
	<head>
		<style>
			/* button and background styling */
			textarea{
			  resize: none;
			}
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
			input[type="text"]{
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
		</style>
	</head>
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
			$VAT_doctor = $_REQUEST['VAT_doctor'];
			$date_timestamp = $_REQUEST['date_timestamp'];
			$SOAP_S = $_REQUEST['SOAP_S'];
			$SOAP_O = $_REQUEST['SOAP_O'];
			$SOAP_A = $_REQUEST['SOAP_A'];
			$SOAP_P = $_REQUEST['SOAP_P'];

			/* selects nurses available at the time of appointment because only those were able to
			assist this consultation that is to be inserted */
			$sql = "SELECT e.VAT, e.employee_name
				FROM employee as e 
				INNER JOIN nurse as n ON e.VAT = n.VAT 
				WHERE e.VAT NOT IN
				(SELECT ca.VAT_nurse FROM consultation_assistant as ca WHERE timestampdiff(HOUR, '$date_timestamp', ca.date_timestamp) = 0)";
			
			$result = $connection->query($sql) or die(mysql_error());
			if ($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			if($result->rowCount() > 0){
				/* if nurses are available so the consultation can be registered */
				/* set of text areas for the user to add soap notes */
				echo("<form name='consultation_form' action='registerconsultation.php' method='post'>");
					echo("<p></p>");
					echo("<h3>SOAP notes</h3>");
					echo("<table>");
					echo("<tr>");
						echo("<td>");	
							echo("<label><textarea cols='35' rows='5' name='SOAP_S' maxlength='250'>${SOAP_S}</textarea><br>Please enter SOAP_S notes</label>");
						echo("</td><td>");
							echo("<label><textarea cols='35' rows='5' name='SOAP_O' maxlength='250'>${SOAP_O}</textarea><br>Please enter SOAP_O notes</label>");
						echo("</td><td>");
							echo("<label><textarea cols='35' rows='5' name='SOAP_A' maxlength='250'>${SOAP_A}</textarea><br>Please enter SOAP_A notes</label>");
						echo("</td><td>");
							echo("<label><textarea cols='35' rows='5' name='SOAP_P' maxlength='250'>${SOAP_P}</textarea><br>Please enter SOAP_P notes</label>");
						echo("</td>");
					echo("</tr>");
					echo("</table>");

					echo("<input type='hidden' id='VAT_doctor' name='VAT_doctor' value='$VAT_doctor'><br>");
					echo("<input type='hidden' id='date_timestamp' name='date_timestamp' value='$date_timestamp'><br>");

					echo("<p></p>");
					echo("<p></p>");

					$index = 0;
					foreach($result as $row){
						$nurse[$index][0] = $row['employee_name'];
						$nurse[$index][1] = $row['VAT'];
						$index++;
					}
					/* for each available nurse a dropdown list is created so the user can add several 
					nurses at once */
					echo("<p>Select at least one nurse who assited this consultation:</p>");
					for($i = 0; $i < $index; $i++){

						echo("<p><select name='$i' id='$i'>");
						echo("<option value=''>Select...</option>");
						for($l = 0; $l < $index; $l++)
						{
							$name_nurse = $nurse[$l][0];
							$VAT_nurse = $nurse[$l][1];
							echo("<option value='$VAT_nurse'>${name_nurse} (${VAT_nurse})</option>");
						}
						echo("</select></p>");
					}

					echo("<input type='hidden' id='n_nurses' name='n_nurses' value='$index'><br>");
					
					echo("<p></p>");
					echo("<button class='button button1' value='Submit' type='button' onclick='checkforduplicates($index)'>Submit</button>");
				echo("</form>");
			}
			else{
				echo("<p>This appointment can't be registered as a consultation because there were no available nurses at the time</p>");
			}
		?>
		<script>
			/* this javascript script checks for duplicate nurses or if the user has not chosen
			at least one nurse */
			function checkforduplicates(count) {
				var filled = 0;
				var aux1, aux2;
				var index;
			    for(j = 0; j < count; j++){
			    	index = j.toString();
					aux1 = document.getElementById(index).value;
					if(aux1 != ''){
						filled++;
					}

					for(k = j + 1; k < count; k++)
					{
						index = k.toString();
						aux2 = document.getElementById(index).value;
						if(aux1 != '' && aux1 == aux2){
							alert('You have duplicate nurses!');
							return false;
						}
					}
				}
				if(filled == 0){
					alert('You must enter at least one nurse!');
					return false;
				}
				consultation_form.submit();
			}
		</script>
	</body>
</html>