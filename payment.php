<?php include('header.php') ?>

<div id="content">
    <form name="registrationForm" id="registrationForm" method="post" onsubmit="return validate()" action="processForm.html">
        <fieldset>
            <legend>Personal Information</legend>
            <table>
                <tr>
                    <td>
                        <span class="required">*</span><label for="firstName">First Name:</label>
                    </td>
                    <td>
                        <input type="text" name="firstName" id="firstName">
                    </td>
                    <td>
                        <div id="firstnameError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="lastName">Last Name:</label>
                    </td>
                    <td>
                        <input type="text" name="lastName" id="lastName">
                    </td>
                    <td>
                        <div id="lastnameError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="address">Address:</label>
                    </td>
                    <td>
                        <input type="text" name="address" id="address" size="40">
                    </td>
                    <td>
                        <div id="addressError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="city">City:</label>
                    </td>
                    <td>
                        <input type="text" name="city" id="city">
                    </td>
                    <td>
                        <div id="cityError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="province">Province:</label>
                    </td>
                    <td>
                        <select name="province" id="province" size="1">
                            <option>Select a province</option>
                            <option value="BC">British Columbia</option>
                            <option value="AB">Alberta</option>
                            <option value="SK">Saskatchewan</option>
                            <option value="MB">Manitoba</option>
                            <option value="ON">Ontario</option>
                            <option value="QC">Québec</option>
                            <option value="NB">New Brunswick</option>
                            <option value="NS">Nova Scotia</option>
                            <option value="PE">Prince Edward Island</option>
                            <option value="NF">Newfoundland</option>
                            <option value="YK">Yukon</option>
                            <option value="NWT">Northwest Territories</option>
                            <option value="NU">Nunavut</option>
                        </select>
                    </td>
                    <td>
                        <div id="provinceError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="postalCode">Postal Code:</label>
                    </td>
                    <td>
                        <input type="text" name="postalCode" id="postalCode" maxlength="6">
                    </td>
                    <td>
                        <div id="postalCodeError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="emailAddress">Email address:</label></td>
                    <td>
                        <input type="text" name="emailAddress" id="emailAddress">
                    </td>
                    <td>
                        <div id="emailAddressError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="phone">Phone:</label>
                    </td>
                    <td>
                        <input type="text" name="phone" id="phone">
                    </td>
                    <td>
                        <div id="phoneError" class="error"></div>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Payment Information</legend>
            <table>
                <tr>
                    <td>
                        <span class="required">*</span><label for="creditCardType" id="creditCardType" class="creditCardType">Credit Card Type:</label>
                    </td>
                    <td class="creditCardType">
                        <img src="images/visa.png" alt="visa" title="Visa Credit Card"><input type="radio" name="creditCardType" id="creditCardTypeVisa" value="visa" class="creditCardType">

                        <img src="images/mastercard.png" alt="MasterCard" title="MasterCard Credit Card"><input type="radio" name="creditCardType" id="creditCardTypeMasterCard" value="masterCard" class="creditCardType">

                        <img src="images/amex.png" alt="AMEX" title="American Express Credit Card"><input type="radio" name="creditCardType" id="creditCardTypeAmex" value="amex" class="creditCardType">
                    </td>
                    <td>
                        <div id="creditTypeError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label for="creditCardNumber">Credit Card Number</label>
                    </td>
                    <td>
                        <input type="text" name="creditCardNumber" id="creditCardNumber" class="creditCardNumber">
                    </td>
                    <td>
                        <div id="creditCardNumberError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="required">*</span><label>Expiry(MM/YY)</label>
                    </td>
                    <td>
                        <input type="text" name="expiry" id="expiry" maxlength="5" placeholder="MM/YY">
                    </td>
                    <td>
                        <div id="expiryError" class="error"></div>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Agree and Submit</legend>
            <table>
                <tr>
                    <td>
                        Check if you agree with our Terms and Conditions
                    </td>
                    <td>
                        <input type="checkbox" name="agreeToTerms" id="agreeToTerms">
                    </td>
                    <td>
                        <div id="agreeToTermsError" class="error"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="btnSubmit" class="btn" id="btnSubmit" value="Submit Registration">
                    </td>
                    <td>
                        <input type="reset" name="btnReset" id="btnReset" value="Reset Form"></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <script language="javascript" type="text/javascript">
        var creditCardType = document.forms["registrationForm"]["creditCardType"];
        var creditCardNumber = document.forms["registrationForm"]["creditCardNumber"];
        var agreeToTerms = document.forms["registrationForm"]["agreeToTerms"];

        var creditTypeError = document.getElementById("creditTypeError");
        var creditCardNumberError = document.getElementById("creditCardNumberError");
        var expiryError = document.getElementById("expiryError");
        var agreeToTermsError = document.getElementById("agreeToTermsError");

        firstName.addEventListener("blur", firstNameVerify, true);
        lastName.addEventListener("blur", lastNameVerify, true);
        address.addEventListener("blur", addressVerify, true);
        city.addEventListener("blur", cityVerify, true);
        province.addEventListener("blur", provinceVerify, true);
        postalCode.addEventListener("blur", postalCodeVerify, true);
        emailAddress.addEventListener("blur", emailAddressVerify, true);
        phone.addEventListener("blur", phoneVerify, true);

        creditCardType.addEventListener("blur", creditCardTypeVerify, true);
        creditCardNumber.addEventListener("blur", creditCardNumberVerify, true);
        expiry.addEventListener("blur", expiryVerify, true);
        agreeToTerms.addEventListener("blur", agreeToTermsVerify, true);


        function validate() {

            if (firstName.value == "") {
                firstName.style.border = "1px solid red";
                firstnameError.textContent = "*First name is required";
                firstName.focus();
                return false;
            }

            if (lastName.value == "") {
                lastName.style.border = "1px solid red";
                lastnameError.textContent = "*Last name is required";
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

            if (emailAddress.value == "") {
                emailAddress.style.border = "1px solid red";
                emailAddressError.textContent = "*Email address is required";
                emailAddress.focus();
                return false;
            }

            if (phone.value == "") {
                phone.style.border = "1px solid red";
                phoneError.textContent = "*Phone is required";
                phone.focus();
                return false;
            }

            creditCardTypeVerify("Please select a Card Type");


            if (creditCardNumber.value == "" || creditCardNumber.value.length < 15 || isNaN(creditCardNumber.value)) {
                creditCardNumber.style.border = "1px solid red";
                creditCardNumberError.textContent = "*Credit card number is required";
                creditCardNumber.focus();
                return false;
            }

            if (expiry.value == "" || expiry.value.length < 4) {
                expiry.style.border = "1px solid red";
                expiryError.textContent = "*Expiry date is required (MM/YY)";
                expiry.focus();
                return false;
            }

            var value = false;

            if (agreeToTerms.checked) {
                value = true;
            }

            if (value == false) {
                alert("Must check the agree box to continue.");
                return false;
            } else {
                return true;
            }

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
                lastnameError.innerHTML = "";
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

        function emailAddressVerify() {

            if (emailAddress.value != "") {
                emailAddress.style.border = "1px solid blue";
                emailAddressError.innerHTML = "";
                return true;
            }
        }

        function phoneVerify() {

            if (phone.value != "") {
                phone.style.border = "1px solid blue";
                phoneError.innerHTML = "";
                return true;
            }

        }


        function creditCardTypeVerify(msg) {

            var value = false;
            for (var i = 0; i < creditCardType.length; i++) {
                if (creditCardType[0].checked || creditCardType[1].checked || creditCardType[2].checked) {
                    value = true;
                }
            }
            if (value == false) {
                alert(msg);
                return false;
            } else {
                return true;
            }
        }

        function creditCardNumberVerify() {

            if (creditCardNumber.value != "") {
                creditCardNumber.style.border = "1px solid blue";
                creditCardNumberError.innerHTML = "";
                return true;
            }
        }

        function expiryVerify() {

            if (expiry.value != "") {
                expiry.style.border = "1px solid blue";
                expiryError.innerHTML = "";
                return true;
            }
        }

    </script>
</div><!-- End Content -->
<?php include('footer.php') ?>
