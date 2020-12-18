<!-- This page is a form. It asks the user for input about the
date and time to check for free doctors in the DB -->
<html>
<head>
	<title>Dental Clinic - Group 42</title>
	<script>
		function goBack() {
			window.history.back()
		}
	</script>

	<style>
		/* button and background styling */
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

		td.hidden {
			visibility: hidden;
		}
		body {
			background-image: url('dental_registration.jpg');
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
		<?php
			/*fetching of variables posted to this page by a form*/
			$name = $_REQUEST['name'];
			$VAT = $_REQUEST['VAT'];
			
			/* form for user to insert the date and time in which to shcedule the appointment */
			echo("<form action='showfreedocs.php' method='post'>");
				echo("<h1 style='text-align:center;'>Appointment Schedule</h1>");
				echo("<p></p>");
				echo("<h3 style='text-align:center;'>Client Name:" . $name . "</h3>");
				echo("<h3 style='text-align:center;'>Client VAT: " . $VAT . "</h3>");
	
				echo("<input type='hidden' id='VAT' name='VAT' value='$VAT'><br>");
				echo("<input type='hidden' id='name' name='name' value='$name'><br>");

				echo("<fieldset>");
				/* the date lower limit is the current date */
				echo("<label><input type='date' name='date' min=" . date("Y-m-d") . " required/>
				Insert a Data to the Consultation</label>");
				echo("<label><select name='formhour' required>");
				/* dropdown list with the available hours to schedule (9am to 5pm, exact hours) */
				  echo("<option value=''>Select...</option >");
				  echo("<option value='09:00:00.00'>9h</option >");
				  echo("<option value='10:00:00.00'>10h</option >");
				  echo("<option value='11:00:00.00'>11h</option >");
				  echo("<option value='12:00:00.00'>12h</option >");
				  echo("<option value='13:00:00.00'>13h</option >");
				  echo("<option value='14:00:00.00'>14h</option >");
				  echo("<option value='15:00:00.00'>15h</option >");
				  echo("<option value='16:00:00.00'>16h</option >");
				  echo("<option value='17:00:00.00'>17h</option >");
				echo("</select>");
				echo("<br>Select the Hour that you want!</label>");
				echo("<label><input type='text' name='description' required/>");
				echo("Insert a Small Textual Descprition </label>");
				echo("</fieldset>");
				echo("<button  class='button button1' type='submit'>Show Available Doctors</button>");
			echo("</form>");
			echo("<form action='appshow.php' method='post'>");
			echo("<input type='hidden' name='type[info]' value='$name:$VAT'>");
			echo("<button class='button button3' type='submit'>Back to Appointments' List </button>");
			echo("</form>");

		?>
		<form action="index.php" method="post">
			<button class="button button2" type="submit">Back to the main page</button>
		</form>
	</body>
</html>


