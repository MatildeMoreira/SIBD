<!-- main page -->
<!-- starting point of the application -->
<?php
	session_start();
?>
<html>
	<head>
		<title> Dental Clinic - Group 42</title>
	</head>
	<style>
		/*background and button styling*/
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
		width: 400px;
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

		body {
		background-image: url('teeth_dental.care.jpg');
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
		}
	</style>
	</head>
	<body>	
		<?php
				/* definition of session variables (username and password of the DB) */
				$_SESSION['user'] = 'ist425437';
				$_SESSION['pass'] = 'pojz6198';
		?>
	
		<form action="clientsearchform.php" method="post">
			<h1 style="text-align:center;">Dental Clinic <i>Stay Smiling</i> - Group 42</h1>
			<h2  style="text-align:center;">Project of <strong>Information Systems and Databases</strong> - Part <strong>3</strong></h2>			
			<button class="button button1" type="submit"><b>Scheduling an Appointment</b></button>
		</form>
		
		<form action="viewemployee.php" method="post">
			<button class="button button2" type="submit"><b>List all Employees</b></button>
		</form>
		<form action="viewclient.php" method="post">
			<button class="button button3" type="submit"><b>List all Clients</b></button>
		</form>
	</body>
</html>


