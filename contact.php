<?php 
require_once('./dao/customerDAO.php'); 
include('header.php');
?>

<?php

    try{
        $customerDAO = new customerDAO();
        //Tracks errors with the form fields
        $hasError = false;
        //Array for our error messages
        $errorMessages = Array();

        //Ensure all three values are set.
        if(isset($_POST['customerName']) ||
           isset($_POST['phoneNumber']) || 
           isset($_POST['emailAddress'])|| 
           isset($_POST['referrer']) ){

            //Validate inputs
            if(is_numeric($_POST['customerName']) || $_POST['customerName'] == ""){
                $hasError = true;
                $errorMessages['customerNameError'] = '*Name is required.';
            }

            if(!is_numeric($_POST['phoneNumber']) || $_POST['phoneNumber'] == ""){
                $errorMessages['phoneNumberError'] = "*Phone number is required.";
                $hasError = true;
            }

            if($_POST['emailAddress'] == ""){
                $errorMessages['emailAddressError'] = "*Email is required.";
                $hasError = true;
            }

            if(!preg_match("/@/",$_POST["emailAddress"])) {
                $errorMessages['emailAddressError'] = "*Enter a valid email.";
                $hasError = true;
            }
            
            if (isset($_POST['referrer'])){
                if($_POST['referrer'] == ""){
                    $errorMessages['referrerError'] = "*Referrer is required.";
                    $hasError = true;
                }
            }

            if($hasError == false){
                $email = $_POST['emailAddress'];
                $hash = password_hash($email, PASSWORD_DEFAULT);
                $customer = new Customer($_POST['customerName'], $_POST['phoneNumber'], $hash, $_POST['referrer']);
                $addSuccess = $customerDAO->addCustomer($customer);
                echo '<h3>' . $addSuccess . '</h3>';
            }
        }

?>

<form name="frmNewsletter" id="frmNewsletter" method="post" action="contact.php" enctype="multipart/form-data">
    <table>
        <tr>
            <th colspan="2">Sign up for News Letter</th>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="customerName" id="customerName" size='40'>
                <?php 
                    if(isset($errorMessages['customerNameError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['customerNameError'] . '</span>';
                    }
                ?>
            </td>

        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input type="text" name="phoneNumber" id="phoneNumber" size='40'>
                <?php 
                    if(isset($errorMessages['phoneNumberError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['phoneNumberError'] . '</span>';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Email Address:</td>
            <td><input type="text" name="emailAddress" id="emailAddress" size='40'>
                <?php   
                    if(isset($errorMessages['emailAddressError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['emailAddressError'] . '</span>';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>How did you hear<br> about us?</td>
            <td>Newspaper<input type="radio" name="referrer" id="referrerNewspaper" value="newspaper">
                Radio<input type="radio" name='referrer' id='referrerRadio' value='radio'>
                TV<input type='radio' name='referrer' id='referrerTV' value='TV'>
                Other<input type='radio' name='referrer' id='referrerOther' value='other'>
                <?php 
                    if(isset($errorMessages['referrerError'])){
                        echo '<span style=\'color:red\'>' . $errorMessages['referrerError'] . '</span>';
                    }
                ?>
            </td>
        <tr>
            <!--File Upload form-->
            <td>Upload file:</td>
            <td colspan='2'><input type='file' name='btnFile' id='btnFile' value='Choose file!'>&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
        </tr>
        <?php
           error_reporting(E_ERROR | E_WARNING | E_PARSE);
           $uploadDir = getcwd() . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR; //path you wish to store you uploaded files
           $uploadPath = $uploadDir . $_FILES['btnFile']['name'];

            if (in_array($_FILES['btnFile']['type'], ["text/plain"]) && $_FILES['btnFile']["size"] < (5 * 1024 * 1024)){
               if (is_dir($uploadDir) && move_uploaded_file($_FILES['btnFile']['tmp_name'], $uploadPath)) {
                      echo "The file " . basename($_FILES['btnFile']['name']) . " is uploaded!";

               } else {
                      echo "Problem uploading file";

               }

            // Check if file already exists
             if (file_exists($uploadPath)) {
             echo "Sorry, file already exists.";

            }

           } else {

           }

           die();

        ?>
    </table>

    <?php
        }catch(Exception $e){
        //If there were any database connection/sql issues,
        //an error message will be displayed to the user.
            echo '<h3>Error on page.</h3>';
            echo '<p>' . $e->getMessage() . '</p>';            
        }
    ?>
</form>

<?php include('footer.php'); ?>
