<?php 
include('header.php');
require_once('Admin.php');
session_start();

$hasError = false;
//Check for errors 
if(isset($_POST['submit'])) {
	if(isset($_POST['username']) && isset($_POST['password'])) {
		if( isset($_POST['username']) ||
		   isset($_POST['password']) ) {

			if($_POST['username'] == "") {
				$hasError = true;
				$errorMessages['usernameError'] = '*Name is required.';
			}

			if($_POST['password'] == "") {
				$hasError = true;
				$errorMessages['passwordError'] = '*Password is required.';
			}
		}
	}
}

if(isset($_POST['username']) && isset($_POST['password'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$Admin = new Admin();

	$Admin->authenticate($username, $password);

//Validate admin
	if ($Admin->isAuthenticated()) {
		$_SESSION['AdminID'] = $Admin->getID();
		$_SESSION['Admin']= $Admin;
		header('Location:mailinglist.php');
	} else {
		$errorMessages['adminError'] = '*Incorrect username or password.';
	}

}       

?>

<form name="login" id="login" method="post" action="login.php">
	<table style="margin: auto;">
		<tr>
			<th style="font-size: 22px">Admin login</th>
			<td>
				<?php 
				if(isset($errorMessages['adminError'])){
					echo '<span style=\'color:red\'>' . $errorMessages['adminError'] . '</span>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Username: </td>
			<td><input type="username" name="username" id="username"></td>
			<td>
				<?php 
				if(isset($errorMessages['usernameError'])){
					echo '<span style=\'color:red\'>' . $errorMessages['usernameError'] . '</span>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="password" name="password" id="password"></td>
			<td>
				<?php 
				if(isset($errorMessages['passwordError'])){
					echo '<span style=\'color:red\'>' . $errorMessages['passwordError'] . '</span>';
				}
				?>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" id="submit" value="Login"></td>
			<td><input type="reset" name="reset" id="reset" value="Reset"></td>
		</tr>
	</table>
</form>
