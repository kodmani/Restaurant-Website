<?php 
require('header.php');
require_once('./dao/customerDAO.php'); 
require_once('./Admin.php');

session_start();
session_regenerate_id(false);

if(isset($_SESSION['AdminID'])){
	if(!$_SESSION['Admin']->isAuthenticated()){
		header('Location:login.php'); 
	}
} else {
	header('Location:login.php');
}

//admin information
echo '<div>'.'SessionID: ' . session_id() .'</div>';
echo '<div> AdminID: ' . $_SESSION['AdminID'] . '</div>';
if($_SESSION['Admin']->getDate()!=null) {
	echo '<div> Last login date: ' . $_SESSION['Admin']->getDate(). '</div>';
}
echo("<button onclick=\"location.href='logout.php'\">Logout!</button>");

?>

<?php
try{
	$customers = $customerDAO->getCustomers();
	
	if($customers){
//Display customers
		echo '<table border=\'5\'>';
		echo '<tr><th>Customer Name</th><th> Phone number </th><th> Email address </th><th>Referrer</th>';
		foreach($customers as $customer){
			echo '<tr>';
			echo '<td>' . $customer->getCustomerName() . '</td>';
			echo '<td>' . $customer->getPhoneNumber() . '</td>';
			echo '<td>' . $customer->getEmailAddress() . '</td>';
			echo '<td>' . $customer->getReferrer() . '</td>';
			echo '</tr>';
		}
	}

}catch(Exception $e){

	echo '<h3>Error on page.</h3>';
	echo '<p>' . $e->getMessage() , '</p>';            
}
?> 

<?php include('footer.php'); ?>

