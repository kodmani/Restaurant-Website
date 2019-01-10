<?php include('header.php'); include "connect.php"; ?>
<?php

if (isset($_POST['submitBtn'])) {

    if (isset($_POST['firstName']) ||
        isset($_POST['lastName']) ||
        isset($_POST['address']) ||
        isset($_POST['city']) ||
        isset($_POST['province']) ||
        isset($_POST['postalCode']) ||
        isset($_POST['phone']) ||
        isset($_POST['cateringOrder'])) {

        if($connect){
            $sql = "INSERT INTO orders";
            $sql .= "(firstName, lastName, address, city, province, postalCode, phone, cateringOrder)";
            $sql .= "VALUES (";
            $sql .=  "'" .$_POST['firstName']."' , ";
            $sql .= "'" .$_POST['lastName']."' , ";
            $sql .= "'" .$_POST['address']."' , ";
            $sql .= "'" .$_POST['city']."'";
            $sql .= "'" .$_POST['province']."'";
            $sql .= "'" .$_POST['postalCode']."'";
            $sql .= "'" .$_POST['phone']."'";
            $sql .= "'" .$_POST['cateringOrder']."'";
            $sql .= ")";
            $result = mysqli_query($connect, $sql);
            return '<span style=color:pink;> ORDERED !! </span>';
        }  else {
            return 'Could not connect to Database.';
        }
    }

}


?>
<form name="orderForm" class="orderForm" id="orderForm" method="post" onsubmit="return validate()" action="payment.php">
    <fieldset>
        <table name="orderInfo" class="orderInfo" id="orderInfo" style="display: inline-block;">
            <legend>Order Information</legend>
            <th>Write down your order here:</th>
            <tr>
                <td>
                    <textarea name="cateringOrder" class="cateringOrder" id="cateringOrder"></textarea>
                </td>
            </tr>
        </table>

        <table name="submitInfo" class="submitInfo" id="submitInfo">
            <tr>
                <th>Submit</th>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="submitBtn" id="submitBtn" value="Submit"/>
                </td>
                <td>
                    <input type="reset" class="btn" name="btnReset" id="btnReset" value="Reset Form"/>
                </td>
            </tr>
        </table>

    </fieldset>
</form>

<script language="javascript" type="text/javascript">
    var firstName = document.forms["orderForm"]["firstName"];
    var lastName = document.forms["orderForm"]["lastName"];
    var address = document.forms["orderForm"]["address"];
    var city = document.forms["orderForm"]["city"];
    var province = document.forms["orderForm"]["province"];
    var postalCode = document.forms["orderForm"]["postalCode"];

    var firstNameError = document.getElementById("firstNameError");
    var lastNameError = document.getElementById("lastNameError");
    var addressError = document.getElementById("addressError");
    var cityError = document.getElementById("cityError");
    var provinceError = document.getElementById("provinceError");
    var postalCodeError = document.getElementById("postalCodeError");

    firstName.addEventListener("blur", firstNameVerify, true);
    lastName.addEventListener("blur", lastNameVerify, true);
    address.addEventListener("blur", addressVerify, true);
    city.addEventListener("blur", cityVerify, true);
    province.addEventListener("blur", provinceVerify, true);
    postalCode.addEventListener("blur", postalCodeVerify, true);
    widget1qty.addEventListener("blur", widget1qtyVerify, true);
    widget2qty.addEventListener("blur", widget2qtyVerify, true);
    widget3qty.addEventListener("blur", widget3qtyVerify, true);
    shippingType.addEventListener("blur", shippingTypeVerify, true);


    function validate() {

        if (firstName.value == "") {
            firstName.style.border = "1px solid red";
            firstnameError.textContent = "*First name is required";
            firstName.focus();
            return false;
        }

        if (lastName.value == "") {
            lastName.style.border = "1px solid red";
            lastNameError.textContent = "*Last name is required";
            lastName.focus();
            return false;
        }

        if (address.value == "") {
            address.style.border = "1px solid red";
            addressError.textContent = "*Address is required";
            address.focus();
            return false;
        }

        if (city.value == "") {
            city.style.border = "1px solid red";
            cityError.textContent = "*City is required";
            city.focus();
            return false;
        }

        if (province.value == "Select a province") {
            province.style.border = "1px solid red";
            provinceError.textContent = "*Province is required";
            province.focus();
            return false;
        }

        if (postalCode.value == "" || postalCode.value.length != 6) {
            postalCode.style.border = "1px solid red";
            postalCodeError.textContent = "*Postal code is required (6 digits)";
            postalCode.focus();
            return false;
        }

        if (widget1qty.value == 0 && widget2qty.value == 0 && widget3qty.value == 0 || isNaN(widget1qty.value) || isNaN(widget2qty.value) || isNaN(widget3qty.value)) {
            widget1qty.style.border = "1px solid red";
            widget1qtyError.textContent = "*At least 1 order is required";
            widget1qty.focus();
            return false;
        }

        totalOrder();

    } //

    function firstNameVerify() {

        if (firstName.value != "") {
            firstName.style.border = "1px solid blue";
            firstnameError.innerHTML = "";
            return true;
        }

    }

    function lastNameVerify() {

        if (lastName.value != "") {
            lastName.style.border = "1px solid blue";
            lastNameError.innerHTML = "";
            return true;
        }

    }

    function addressVerify() {
        if (address.value != "") {
            address.style.border = "1px solid blue";
            addressError.innerHTML = "";
            return true;
        }
    }

    function cityVerify() {
        if (city.value != "") {
            city.style.border = "1px solid blue";
            cityError.innerHTML = "";
            return true;
        }
    }

    function provinceVerify() {

        if (province.value != "") {
            province.style.border = "1px solid blue";
            provinceError.innerHTML = "";
            return true;
        }
    }

    function postalCodeVerify() {

        if (postalCode.value != "") {
            postalCode.style.border = "1px solid blue";
            postalCodeError.innerHTML = "";
            return true;
        }

    }

    function widget1qtyVerify() {

        if (widget1qty.value != "" || widget1qty.value != 0) {
            widget1qty.style.border = "1px solid blue";
            widget1qtyError.innerHTML = "";
            return true;
        }
    }

    function widget2qtyVerify() {

        if (widget2qty.value != "" || widget2qty.value != 0) {
            widget2qty.style.border = "1px solid blue";
            widget2qtyError.innerHTML = "";
            return true;
        }
    }

    function widget3qtyVerify() {

        if (widget3qty.value != "" || widget3qty.value != 0) {
            widget3qty.style.border = "1px solid blue";
            widget3qtyError.innerHTML = "";
            return true;
        }
    }

    function totalOrder() {

        var total = (widget1qty.value * 5) + (widget2qty.value * 15) + (widget3qty.value * 25);

        if (document.getElementById('shippingTypeStandard').checked) {
            alert('Your total order is: $' + (total + 5));
        }

        if (document.getElementById('shippingTypeExpress').checked) {
            alert('Your total order is: $' + (total + 10));
        }

        if (document.getElementById('shippingTypeOvernight').checked) {
            alert('Your total order is: $' + (total + 20));
        }

    } //

</script>


<?php include('footer.php') ?>
