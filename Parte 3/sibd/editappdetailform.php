<!-- This page is a form. It asks the user for input about the
the details that is to be inserted in a consultation in the DB -->
<?php
	session_start();
?>
<html>
	<head>
		<title> Dental Clinic - Group 42</title>
		<style>
			/*background and button styling*/
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
		<b><h1 style="text-align:center;">Update the Information about Consultation</h1><b>
		<h1>Add information</h1>
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

##############################################SOAP notes########################################
			/* displays textareas filled with the current contents of each soap notes so they can be edited*/
			echo("<form name='consultation_form' action='editappdetail.php' method='post'>");
				echo("<p></p>");
				echo("<h3>SOAP notes</h3>");
				echo("<table>");
				echo("<tr>");
					echo("<td>");
						echo("<label> <h4>SOAP_S: </h4> <textarea cols='35' rows='5' name='SOAP_S' maxlength='250'>${SOAP_S}</textarea><br>Please enter SOAP_S notes</label>");
						echo("Client observations, concerns and insights, as well as opinions and hundches from the doctor!</label>");
					echo("</td><td>");
						echo("<label> <h4>SOAP_O: </h4> <textarea cols='35' rows='5' name='SOAP_O' maxlength='250'>${SOAP_O}</textarea><br>Please enter SOAP_O notes</label>");
						echo("Relevant History, Description for the results from any physical examination!</label>");
					echo("</td><td>");
						echo("<label> <h4>SOAP_A: </h4> <textarea cols='35' rows='5' name='SOAP_A' maxlength='250'>${SOAP_A}</textarea><br>Please enter SOAP_A notes</label>");
						echo("Situation of the Client and contains the differential diagnosis list and a prognosis!</label>");
					echo("</td><td>");
						echo("<label> <h4>SOAP_P: </h4> <textarea cols='35' rows='5' name='SOAP_P' maxlength='250'>${SOAP_P}</textarea><br>Please enter SOAP_P notes</label>");
						echo("Substantive Actions and Activities,includes future diagnostic tests, terapy actions, care recommendations, etc!</label>");
					echo("</td>");
				echo("</tr>");
				echo("</table>");
				echo("<p></p>");
				echo("<p></p>");

				################### nurses ##################################
				/* selects the nurses that are available at the time of the consultation
				because only those are able to assist it */
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
					/* generation of dropdown selections with the nurses that can be added
					to this consultation */
					/* generates as many dropdown list as nurses that can be added to the consultation.
					That way, one can add several nurses at once */
					$nurse_count = 0;
					foreach($result as $row){
						$nurse[$nurse_count][0] = $row['employee_name'];
						$nurse[$nurse_count][1] = $row['VAT'];
						$nurse_count++;
					}
					echo("<p>Select nurses to add to this consultation:</p>");
					for($i = 0; $i < $nurse_count; $i++){
						echo("<p><select name='nurse$i' id='nurse$i'>");
						echo("<option value=''>Select...</option>");
						for($l = 0; $l < $nurse_count; $l++)
						{
							$name_nurse = $nurse[$l][0];
							$VAT_nurse = $nurse[$l][1];
							echo("<option value='$VAT_nurse'>${name_nurse} (${VAT_nurse})</option>");
						}
						echo("</select></p>");
					}
					echo("<input type='hidden' id='n_nurses' name='n_nurses' value='$nurse_count'><br>");
					
					echo("<p></p>");
				}
				else{
					echo("<p>There are no more nurses available</p>");
				}

				################### diagnostics ##################################
				/* selects the diagnostics that have not yet been associated to this consultation.
				This way the user can only add a diagnostic that is different from those already associated*/
				
				$sql = "SELECT dc.ID, dc.description_diagnostic 
						FROM diagnostic_code as dc 
						WHERE dc.ID NOT IN 
							(SELECT con.ID FROM consultation_diagnostic as con  
							WHERE timestampdiff(HOUR, '$date_timestamp', con.date_timestamp) = 0 
							AND con.VAT_doctor = '$VAT_doctor');";
				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}
				if($result->rowCount() > 0){
					/* generation of dropdown selections with the diagnostics that can be added
					to this consultation */
					/* generates as many dropdown lists as diagnostics that can be added to the consultation.
					That way, one can add several diagnostics at once */
					$diagnostic_count = 0;
					foreach($result as $row){
						$diagnostic[$diagnostic_count][0] = $row['ID'];
						$diagnostic[$diagnostic_count][1] = $row['description_diagnostic'];
						$diagnostic_count++;
					
					}
					echo("<p>Select diagnostics to add to this consultation:</p>");
					for($i = 0; $i < $diagnostic_count; $i++){
						echo("<p><select name='diagnostic$i' id='diagnostic$i'>");
						echo("<option value=''>Select...</option>");
						for($l = 0; $l < $diagnostic_count; $l++)
						{
							$diagnostic_ID = $diagnostic[$l][0];
							$description_diagnostic = $diagnostic[$l][1];
							echo("<option value='$diagnostic_ID'>${description_diagnostic} (${diagnostic_ID})</option>");
						}
						echo("</select></p>");
					}
					echo("<input type='hidden' id='n_diagnostics' name='n_diagnostics' value='$diagnostic_count'><br>");
					
					echo("<p></p>");
				}
				else{
					echo("<p>There are no more diagnostics available</p>");
				}


				##############prescriptions######################

				/* selects the diagnostics already associated to this consultation
				because a prescription can only be added if it refers to a diagnostic
				that is associated to the consultation */
				$sql = "SELECT dc.ID, dc.description_diagnostic 
				FROM consultation_diagnostic as con 
				INNER JOIN diagnostic_code as dc
				ON con.ID = dc.ID
				WHERE timestampdiff(HOUR, '$date_timestamp', con.date_timestamp) = 0 
				AND con.VAT_doctor = '$VAT_doctor'";
				$result = $connection->query($sql) or die(mysql_error());
				if ($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}
				if($result->rowCount() > 0){
					/* generation of dropdown selections with the med/lab that can be added
					to this consultation */
					/* generates as many dropdown lists as med/lab that can be added to the consultation.
					That way, one can add several diagnostics at once */
					echo("<h3>Add a prescription to a diagnostic made in this consultation</h3>");
					echo("<p>To add a prescription just fill in one or more of the forms below:</p>");
					$pres_diag_count = 0;
					foreach($result as $row){
						$diag[$pres_diag_count][0] = $row['ID'];
						$diag[$pres_diag_count][1] = $row['description_diagnostic'];
						$pres_diag_count++;
					}
					
					for($i = 0; $i < $pres_diag_count; $i++){
						$id = $diag[$i][0];
						$label = $diag[$i][1];
						echo("<p></p>");
						echo("<b>$label ($id):</b><select name='med_lab$i' id='med_lab$i'>");
						echo("<option value=''>Select medication...</option>");
						/* selection of med/lab that have not yet been prescripted in this consultation for the current diagnostic */
						/* this way the user can only add prescriptions of med/lab that have not yet been added in this consultation for a certain diagnostic */
						$sql = "SELECT m.name_medication, m.lab
						FROM medication as m 
						LEFT JOIN (SELECT * FROM prescription as p 
								   WHERE timestampdiff(HOUR, '$date_timestamp', p.date_timestamp) = 0 
								   AND p.VAT_doctor = '$VAT_doctor'
								   AND p.ID = '$id') as t
						ON m.name_medication = t.name_medication
						AND m.lab = t.lab
						WHERE t.ID IS NULL";
						$result = $connection->query($sql) or die(mysql_error());
						if ($result == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error: {$info[2]}</p>");
							exit();
						}
						if($result->rowCount() > 0){
							foreach($result as $row){
								$med_name = $row['name_medication'];
								$med_lab = $row['lab'];
								echo("<option value='$med_name?$med_lab?$id'>${med_name} (${med_lab})</option>");
							}
						}
						/* dropdown list to add dosage of med */
						echo("</select>&nbsp&nbsp");
						echo("<select name='dosage$i' id='dosage$i'>");
						echo("<option value=''>Select dosage..</option>");
						echo("<option value='100'>100mg</option>");
						echo("<option value='200'>200mg</option>");
						echo("<option value='300'>300mg</option>");
						echo("<option value='400'>400mg</option>");
						echo("<option value='500'>500mg</option>");
						echo("<option value='600'>600mg</option>");
						echo("<option value='700'>700mg</option>");
						echo("<option value='800'>800mg</option>");
						echo("<option value='900'>900mg</option>");
						echo("<option value='1000'>1000mg</option>");
						echo("</select>&nbsp&nbsp");
						/* text area for the user to add dosage regime */
						echo("<input type='text' name='regime$i' id='regime$i'  placeholder='Describe dosage regime'/>");
					}
					echo("<input type='hidden' id='n_pres' name='n_pres' value='$pres_diag_count'><br>");
					
					echo("<p></p>");
				}
				else{
					/* error message if no diagnostics have been found for this consultation */
					echo("<p>There are no diagnostics!<br>You cannot add a prescription without a diagnostic.</p>");
				}
				echo("<input type='hidden' id='VAT_doctor' name='VAT_doctor' value='$VAT_doctor'><br>");
				echo("<input type='hidden' id='date_timestamp' name='date_timestamp' value='$date_timestamp'><br>");
				echo("<button class='button button1' value='Submit' type='button' onclick='checkforduplicates($nurse_count,$diagnostic_count,$pres_diag_count)'>Submit</button>");
			echo("</form>");
			echo("<p></p>");
		?>
		<script>
			/* this javascript script checks for insertion of duplicate nurses, diagnostics or for
			incomplete prescription fields filling */
			function checkforduplicates(nurse_count,diagnostic_count,pres_diag_count) {
				var aux1, aux2, aux3;
				var key;
			    for(j = 0; j < nurse_count; j++){
			    	key = j.toString();
			    	key = 'nurse' + key;
					aux1 = document.getElementById(key).value;
					for(k = j + 1; k < nurse_count; k++)
					{
						key = k.toString();
						key = 'nurse' + key;
						aux2 = document.getElementById(key).value;
						if(aux1 != '' && aux1 == aux2){
							alert('You have duplicate nurses!');
							return false;
						}
					}
				}
			    for(j = 0; j < diagnostic_count; j++){
			    	key = j.toString();
			    	key = 'diagnostic' + key;
					aux1 = document.getElementById(key).value;
					for(k = j + 1; k < diagnostic_count; k++)
					{
						key = k.toString();
						key = 'diagnostic' + key;
						aux2 = document.getElementById(key).value;
						if(aux1 != '' && aux1 == aux2){
							alert('You have duplicate diagnostics!');
							return false;
						}
					}
				}
				for(j = 0; j < pres_diag_count; j++){
			    	key = j.toString();
			    	key = 'med_lab' + key;
					aux1 = document.getElementById(key).value;
					if(aux1 != ''){
						key = j.toString();
			    		key = 'dosage' + key;
						aux2 = document.getElementById(key).value;
						key = j.toString();
			    		key = 'regime' + key;
			    		aux3 = document.getElementById(key).value;
						if(aux2 == '' || aux3 == ''){
							alert('You are missing dosage or regime in a prescription!');
							return false;
						}
					}
				}
				consultation_form.submit();
			}
		</script>
	</body>
</html>