<!-- This page is a form. It asks the user for input about the
the client that is to be added to the DB -->

<html>
	<head>
		<title> Dental Clinic - Group 42</title>
	</head>
	<style>
		/*background and button styling*/
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
	<body>
		<b><h1 style="text-align:center;">Register a Client</h1><b>
		<h3 style="text-align:center;" >Insert the information about the client in the form below</h3>

		<form action="addclient.php" method="post">
			<fieldset>
				<label><input type="text" name="VAT" placeholder="VAT" required/>
				Enter client VAT</label>
				
				<label><input type="text" name="name" placeholder="Name" required/>
				Please enter client name</label>
				<?php
				/*Limitação da data de nascimento à data atual*/
				echo("<label><input type='date' name='birth_date' max=" . date("Y-m-d") . " required/>
				Insert Birth Date</label>");
				?>
				<label><input type="text" placeholder="Road Name" name="street" required/>
				You can enter the street name of the Client</label>
				<label><input type="text" placeholder="City" name="city" required/>
				Enter the City of the Client</label>

				<label><input type="text" placeholder="ZIP Code" name="zip" required/>
				Please enter the ZIP Code of the Client</label>	
				<label style="text-align:center;"><div id="gender" />
           			<label><input type="radio" name="gender" value="female" required>
            		Female</label>
           			<label><input type="radio" name="gender" value="male" required>
           			 Male</label>
        		</div> Gender</label>
				<label><input type="tel" placeholder= "Mobile Phone" name="phone" pattern="[0-9]{9}"/>
				Insert the Phone Number of Client</label>
			</fieldset>


			<input type="hidden" name="all" value="0">
			<button class="button button1" value="Submit" type="submit"/>Submit the Form</button>	
		</form>
		<form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button class="button button1" type="submit"/>Back to the main page</button>
		</form>	
	</body>
</html>