<?php include 'inc/header.php'; ?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $fm->validation($_POST['firstname']);
            $lastname = $fm->validation($_POST['lastname']);
            $email = $fm->validation($_POST['email']);
            $body = $fm->validation($_POST['body']);

            $firstname = mysqli_real_escape_string($db->link, $firstname);
            $lastname = mysqli_real_escape_string($db->link, $lastname);
            $email = mysqli_real_escape_string($db->link, $email);
            $body = mysqli_real_escape_string($db->link, $body);

            $errorf = "";
            $errorl = "";
            $errore = "";
            $errorb = "";

            if (empty($firstname)) {
            	$errorf = "Please enter your first name";
            }
            if (empty($lastname)) {
            	$errorl = "Please enter your last name";
            }
            if (empty($email)) {
            	$errore = "Email required in the field";
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            	$error = "Invaid email address";
            }
            if (empty($body)) {
            	$errorb = "Please enter your message";
            }
            else {
            	$query = "INSERT INTO tbl_contact (firstname,lastname,email,body) VALUES ('$firstname','$lastname','$email','$body') ";
	            $datinsert = $db->insert($query);
	            if ($datinsert) {
	                $message = "Message sent successfully";
	            } else {
	                $error = "Message could not be sent. We are sorry for the incoveniences";
	            }
	        }
    }
?>
<style>
	.cuserror { color: red; float: left; }
</style>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
			<form action="" method="post">
				<table>
				<tr>
					<td>First Name:</td>
					<td> 
						<?php
						if (isset($errorf)) {
							echo "<span class='cuserror'>$errorf</span>";  
						}
						?>
						<input type="text" name="firstname" placeholder="Enter first name" /> 
					</td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td> 
						<?php
						if (isset($errorl)) {
							echo "<span class='cuserror'>$errorl</span>"; 
						}
						?>
						<input type="text" name="lastname" placeholder="Enter Last name" /> 
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td> 
						<?php
						if (isset($errore)) {
							echo "<span class='cuserror'>$errore</span>";  
						}
						?>
						<input type="email" name="email" placeholder="Enter Email Address" /> 
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td> 
						<?php
						if (isset($errorb)) {
							echo "<span class='cuserror'>$errorb</span>"; 
						}
						?>
						<textarea name="body"></textarea> 
					</td>
				</tr>
				<tr>
					<td></td>
					<td> <input type="submit" name="submit" value="Send"/> </td>
				</tr>
		</table>
	<form>		
 </div>
</div>

<?php include 'inc/sidebar.php'; ?>
<?php include 'inc/footer.php'; ?>