<?php
require_once('abstractDAO.php');
require_once('./model/customer.php');

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
* Description of customerDAO
*
* @author Matt
*/
class customerDAO extends abstractDAO {

    function __construct() {
        try{
            parent::__construct();
        } catch(mysqli_sql_exception $e){
            throw $e;
        }
    }

/*
* This is an example of how to use the query() method of a mysqli object.
* 
* Returns an array of <code>Employee</code> objects. If no customers exist, returns false.
*/
public function getCustomers(){
//The query method returns a mysqli_result object
    $result = $this->mysqli->query('SELECT * FROM mailinglist');
    $mailinglist = Array();

    if($result->num_rows >= 1){
        while($row = $result->fetch_assoc()){
//Create a new customer object, and add it to the array.
            $customer = new Customer($row['customerName'], $row['phoneNumber'], $row['emailAddress'], $row['referrer']);
            $mailinglist[] = $customer;
        }
        $result->free();
        return $mailinglist;
    }
    $result->free();
    return false;
}

/*
* This is an example of how to use a prepared statement
* with a select query.
*/
public function getCustomer($customerName){
    $query = 'SELECT * FROM mailinglist WHERE customerName = ?';
    $stmt = $this->mysqli->prepare($query);
    $stmt->bind_param('s', $customerName);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows == 1){
        $temp = $result->fetch_assoc();
        $customer = new Customer($temp['customerName'], $temp['phoneNumber'], $temp['emailAddress'], $temp['referrer']);
        $result->free();
        return $customer;
    }
    $result->free();
    return false;
}

public function addCustomer($customer){

    if(!$this->mysqli->connect_errno){
//insert each value into mailinglist.
        $sql = "INSERT INTO mailinglist";
        $sql .= "(customerName, phoneNumber, emailAddress, referrer)";
        $sql .= "VALUES (";
        $sql .=  "'" .$customer->getCustomerName()."' , ";
        $sql .= "'" .$customer->getPhoneNumber()."' , ";
        $sql .= "'" .$customer->getEmailAddress()."' , ";
        $sql .= "'" .$customer->getReferrer()."'";
        $sql .= ")";
        $result = $this->mysqli->query($sql);
        return '<span style=color:pink;> Signed up! </span>';
    }  else {
        return 'Could not connect to Database.';
    }
}
}

?>
