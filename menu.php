<?php include('header.php');
include('connect.php');

session_start();
//Start loop to get database product table
$selectProducts = "SELECT * FROM products";
$result = mysqli_query($connect, $selectProducts);
?>

<?php
//START PRODUCTS LOOP
if ($result):
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($product = mysqli_fetch_assoc($result)) {
            //print_r($product);
            ?>
            <div class="col-sm-4 col-md-3">
                <form method="post" action="menu.php?action=add&id=<?php echo $product['id']; ?>">
                    <div id="products" align="center">

                        <h4 class="text-info" id="productName">
                            <?php echo $product["name"]; ?>
                        </h4>

                        <!-- Image and imgID -->
                        <img src="images/<?php echo $product['image']; ?>" class="productImg"

                            <?php //pizza image
                            if ($product['image'] == 'pizza2.png') {
                                ?>
                                id="pizzaImg"
                                <?php
                            }
                            ?>

                            <?php //burger image
                            if ($product['image'] == 'burger2.png') {
                                ?>
                                id="burgerImg"
                                <?php
                            }
                            ?>

                            <?php //burger image
                            if ($product['image'] == 'steak2.png') {
                                ?>
                                id="steakImg"
                                <?php
                            }
                            ?>

                             class="img-responsive" width="50px" height="50px"/><br/>

                        <h4>$
                            <?php echo $product["price"]; ?>
                        </h4>

                        <input type="text" id="quantity" name="quantity" value="1" size="2" class="form-control"/>

                        <input type="hidden" id="name" name="name" value="<?php echo $product['name']; ?>"/>

                        <input type="hidden" id="price" name="price" value="<?php echo $product['price']; ?>"/>

                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success"
                               value="Add to Cart"/>

                    </div>
                </form>
            </div>
            <?php
            //end loop
        }
    }
endif;
?>

<?php include "cart.php"; ?>

<div style="clear:both"></div>
<br/>
<div class="table-responsive" id="orderDiv">
    <table id="orderDetails" class="orderDetails">
        <tr>
            <th colspan="5">Order Details</th>
        </tr>
        <tr>
            <th width="5%">Item Name</th>
            <th width="5%">Quantity</th>
            <th width="5%">Price</th>
            <th width="5%">Item Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if (!empty($_SESSION["shoppingCart"])) {
            $total = 0;
            foreach ($_SESSION["shoppingCart"] as $keys => $product) {
                ?>
                <tr>
                    <td>
                        <?php echo $product["name"]; ?>
                    </td>
                    <td>
                        <?php echo $product["quantity"]; ?>
                    </td>
                    <td>$
                        <?php echo $product["price"]; ?>
                    </td>
                    <td>$
                        <?php echo number_format($product["quantity"] * $product["price"], 2); ?>
                    </td>
                    <td><a href="menu.php?action=delete&id=<?php echo $product['id']; ?>"><span class="text-danger">Remove</span></a>
                    </td>
                </tr>
                <?php
                if (isset($product["name"]) ||
                    isset($product["quantity"]) ||
                    isset($product["price"])
                ) {
                    $total = $total + ($product["quantity"] * $product["price"]);
                }
            }//end for each
            ?>

            <tr id="orderRowTax" class="orderRowTax">
                <td colspan="3" align="right">+Tax</td>
                <td>$
                    <?php
                    $tax = ($total * 0.13);
                    echo number_format($tax, 2);
                    ?>
                </td>
                <td rowspan="2">
                    <a href="payment.php"><img src="images/basket.jpg" id="basket" alt="basket" class="basket"/></a>
                </td>
            </tr>
            <tr id="orderRows" class="orderRows">
                <td colspan="3" align="right">Order Total</td>
                <td>$
                    <?php echo number_format(($total + $tax), 2); ?>
                </td>
            </tr>
            <?php
        }//end if
        ?>
    </table>
</div>

<!-- Trigger/Open The Modal -->
<!--  <button type="button" id="myBtn">Open Modal</button>-->

<!-- The Modal -->
<div id="pizzaModal" class="modal">
    <!-- Modal content -->
    <div id="pizzaContent" class="modal-content">
        <span class="close">&times;</span>

        <p style="display: inline;">Size: </p>
        <select size="1">
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
            <option value="xLarge">X-Large</option>
        </select>
        <ul id="toppingsList" class="toppingsList">
            <p>Toppings: </p>
            <li name="Mushrooms" id="Mushrooms" class="Mushrooms">Mushrooms: <input type="checkbox" class="checkbox"/>
            </li>
            <li name="Onions" id="Onions" class="Onions">Onions: <input type="checkbox" class="checkbox"/></li>
            <li name="Pepperoni" id="Pepperoni" class="Pepperoni">Pepperoni: <input type="checkbox" class="checkbox"/>
            </li>
            <li name="Olives" id="Olives" class="Olives">Olives: <input type="checkbox" class="checkbox"/></li>
        </ul>
    </div>
</div>

<!-- The Modal -->
<div id="burgerModal" class="modal">
    <!-- Modal content -->
    <div id="burgerContent" class="modal-content">
        <span class="close2"></span>

        <p>VERY NICE AND YUMMY BURGER</p>
    </div>
</div>

<?php

/*$selectPizza = "select * from mo_restaurant.products where image = 'pizza2.png'";
$resultP = mysqli_query($connect, $selectPizza);

if (mysqli_num_rows($resultP) > 0) {
    while($pizzaPic = mysqli_fetch_assoc($resultP)) {
?>
        <div>
        <img src="images/<?php echo $pizzaPic['image']; ?>" id="pizzaPic" />
        </div>
<?php
        echo "
            <script> 
                var pizzaImg = document.getElementById('pizzaPic');
            </script>
        ";
    }
}*/
?>

<script>
    //Collapsible
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    //modal
    var pizzaModal = document.getElementById('pizzaModal');
    var burgerModal = document.getElementById('burgerModal');

    var btn = document.getElementById("myBtn");

    var span = document.getElementsByClassName("close")[0];
    var burgerSpan = document.getElementsByClassName("close2")[0];

    var pizzaImg = document.getElementById('pizzaImg');
    var burgerImg = document.getElementById('burgerImg');

    // When the user clicks the button, open the modal 
    pizzaImg.onclick = function () {
        pizzaModal.style.display = "block";
    }

    // When the user clicks the button, open the modal 
    burgerImg.onclick = function () {
        burgerModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        pizzaModal.style.display = "none";
    }
    burgerSpan.onclick = function () {
        burgerModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == pizzaModal || event.target == burgerModal) {
            pizzaModal.style.display = "none";
            burgerModal.style.display = "none";
        }
    }

    //hide shopping cart if empty
    <?php
    if(empty($_SESSION["shoppingCart"])){
        ?>
    orderDiv.style.display = 'none';
    <?php
    }
    ?>

</script>

<?php include('footer.php') ?>
