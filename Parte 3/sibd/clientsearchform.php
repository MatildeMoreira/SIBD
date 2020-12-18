<!-- This page is a form. It asks the user for input about the
the client that is to be searched in the DB -->
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
	<b><h1 style="text-align:center;">Search for a client</h1><b>
	<h3 style="text-align:center;" >Insert client's VAT, a (part of the) name for the client, and/or the (parts of the) address</h3>
	<form name="client_form" action="clientsearch.php" method="post">
		<fieldset>
			<label><input type="text" name="search_name" placeholder="Name"/>
			Please enter client name</label>

			<label><input type="text" name="search_VAT"  placeholder="VAT"/>
			Enter client VAT</label>

			<label><input type="text" placeholder="Road Name" name="search_street">
			You can enter the street name of the Client</label>
			
			<label><input type="text" placeholder="City" name="search_city">
			Enter the City of the Client</label>

			<label><input type="text" placeholder="ZIP Code" name="search_zip">
			Please enter the ZIP Code of the Client</label>
		</fieldset>
		<input type="hidden" name="all" value="0">
		<button class="button button1" value="Submit" type="button" onclick="LookIfEntryEmpty()">Click to Search</button>
	</form>
	<form action="index.php" method="post">
		<input type="hidden" name="all" value="1">
		<button class="button button1" type="submit"/>Back to the main page</button>
	</form>
	<form action="clientsearch.php" method="post">
		<input type="hidden" name="all" value="1">
		<button class="button button1" type="submit"/>All Clients</button>
	</form>
	<script>
	/* script to check if at least one field was filled*/
	function LookIfEntryEmpty() {
		if ((client_form.search_VAT.value != '')||(client_form.search_name.value != '')||(client_form.search_street.value != '')||(client_form.search_city.value != '')||(client_form.search_zip.value != '')){
			client_form.submit();
		}
		else if ((client_form.search_street.value != '')||(client_form.search_city.value != '')||(client_form.search_zip.value != '')) {
			client_form.submit();
		}
		else {
			/* if not fields are filled returns error message */
			alert('You must fill in at least one field!');
			return false;
		}
	}
  </script>
</body>
</html>