<!-- This page is a form that asks user to input the information
to update about a given client -->
<?php
	session_start();
?>
<html>
    <head>
        <title> Dental Clinic - Group 42</title>
        <style>
            /* button and background styling */
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

        </style>
    </head>
    <body>
    	<h1 style="text-align:center;">Update a Client</h1>
		<h2 style="text-align:center;" >Update the information about the client in the form below</h2>

        <tr>
            <form action="updateClient.php" method="post">
                <?php
                    /*fetching of variables posted to this page by a form*/
                    $raw = $_POST['type']['info'];
                    $info = explode(":",$raw,2);           
                    $Name_Client = $info[0];
                    $VAT_Client = $info[1];
                    echo("<h3 style='text-align:center;'>Client VAT: ${VAT_Client}</h3>");
                    echo("<h3 style='text-align:center;'>Client Name: ${Name_Client}</h3>");
                    echo("<fieldset>");
                    /* birth date upper limit is the current date */
                    echo("<label><p><b>Insert Birth Date<b></p><input type='date' name='birth_date' max=" . date("Y-m-d") . " />
                    </label>");
                ?>
                <p><input type="hidden" name="VAT_Client" value="<?=$VAT_Client?>"/></p>
	        	<p><input type="hidden" name="Client_Name" value="<?=$Name_Client?>"/></p>
                <p></p>
                <label><p>You can enter the street name of the Client</p><input type="text" placeholder="Road Name" name="street" />
				</label>
                <p></p>				
                <label><p>Enter the City of the Client<b></p><input type="text" placeholder="City" name="city" />
				</label>
                <p></p>				
				<label><p>Please enter the ZIP Code of the Client</p><input type="text" placeholder="ZIP Code" name="zip" />
				</label>	
                <p></p>				                
				<label"><p>Gender</p><div id="gender" />
           			<label><input type="radio" name="gender" value="female" >
            		Female</label>
           			<label><input type="radio" name="gender" value="male" >
           			 Male</label>
        		</div></label>
                <p></p>				
                <label><p>Insert the Phone Number of Client</p><input type="tel" placeholder= "Mobile Phone" name="phone" pattern="[0-9]{9}"/>
				</label>
                </fieldset>
                <input type="hidden" name="all" value="0">
			    <button class="button button2" value="Submit" type="submit"/>Submit the Form</button>	
	    	</form>
        </tr> 
        <form action="index.php" method="post">
			<input type="hidden" name="all" value="1">
			<button class="button button2" type="submit"/>Back to the main page</button>
		</form> 
        </body>
</html>