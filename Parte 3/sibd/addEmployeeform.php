<!-- This page is a form. It asks the user for input about the
the employee that is to be added to the DB -->
<html>
	<head>
		<title> Dental Clinic - Group 42</title>
	    <link rel="stylesheet" type="text/css" href="revealCheckBox.css">
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
			width: 500px;
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
		<b><h1 style="text-align:center;">Register an Employee</h1><b>
		<h3 style="text-align:center;" >Insert the information about the employee in the form below</h3>

		<form action="addEmployee.php" method="post">
			<fieldset>
				<div>
					<label><input type="text" name="VAT" placeholder="VAT" required/>
					Enter employee VAT</label>
					
					<label><input type="text" name="name" placeholder="Name" required/>
					Please enter employee name</label>
					<?php
					// Limitação da data de nascimento à data atual
					echo("<label><input type='date' name='birth_date' max=" . date("Y-m-d") . " required/>
					Insert Birth Date</label>");
					?>
					<br><br>
					<label><input type="text" placeholder="Road Name" name="street" required/>
					You can enter the street name of the Employee</label>
					<label><input type="text" placeholder="City" name="city" required/>
					Enter the City of the Employee</label>
					<label><input type="text" placeholder="ZIP Code" name="zip" required/>
					Enter the ZIP Code of the Employee</label>	
					<br><br>
					<label><input type="text" placeholder="IBAN" name="IBAN" required/>
					Please enter the IBAN of the Employee</label>	
					<label><input type="text" placeholder="Salary..." name="salary" required/>
					Please enter the Salary of the Employee</label>
					<label><input type="tel" placeholder= "Mobile Phone" name="phone" pattern="[0-9]{9}" required/>
					Phone Number of Employee</label>
					<br><br>
					
					
					<label>Insert a JOB POSITION<div class="row" id="jobposition" />
						<label>Receptionist<input type="radio" name="jobposition" value="receptionist" required>
						<br></label>
						<label>Nurse<input type="radio" name="jobposition" value="nurse" required>
						<br></label>
						<div>
							<label>Doctor<input type="radio" name="jobposition" value="doctor" id="doctorID" required>
							<div class="reveal-if-active">
								<label for="specialization">What's your specialization?
								<input type="text" id="specialization" name="sepecialization" class="require-if-active" data-require-pair="#doctorID">
								</label>
								<label for="biography">Insert your biography
								<input type="text" id="biography" name="biography" class="require-if-active" data-require-pair="#doctorID">
								</label>
								<label for="email">What's your E-mail?
								<input type="text" id="email" name="email" class="require-if-active" data-require-pair="#doctorID">
								</label>
								<label>What is the type of doctor<div id="typeDoctor"/>
									<label>Trainee Doctor
									<input type="radio" name="typeDoctor" value="traineeDoctor" id="trainDoc">
									<div class="reveal-if-active">
										<label for="VAT_PermDoct">VAT Doctor Supervisor
										<input type="text" id="VAT_PermDoct" name="VAT_PermDoct" class="require-if-active" data-require-pair="#trainDoc">
										</label>
									</div>
									</label>
									<label>Permanent Doctor<input type="radio" name="typeDoctor" value="permanentDoctor" id="permDoc">
									<div class="reveal-if-active">
										<label for="numYears">Number of years working
										<input type="text" id="numYears" name="numYears" class="require-if-active" data-require-pair="#permDoc">
										</label>
									</div>
									</label>
								</div></label>
							</div>		
						</div>
						</label>
					</div></label>
				</div>
				<label></label><label></label><label></label><label></label><label></label>
				<label></label><label></label><label></label><label></label><label></label>
			</fieldset>
			<br>
			<br>
			<input type="hidden" name="all" value="0">
			<button class="button button1" value="Submit" type="submit" onclick="display()"/>Submit the Form</button>	
		</form>
		<form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button class="button button1" type="submit"/>Back to the main page</button>
		</form>	
	</body>
</html>