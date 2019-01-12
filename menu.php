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

<!-- The Modal -->
<div id="steakModal" class="modal">
    <!-- Modal content -->
    <div id="steakContent" class="modal-content">
        <h3>Steak cooked at your level of choice</h3>
        <ul id="toppingsList" class="toppingsList">
            <h4>Doneness: </h4><br />
            <li name="rare" id="rare" class="rare">rare: <input type="checkbox" class="checkbox" checked/>
            </li>
            <li name="mediumRare" id="mediumRare" class="mediumRare">medium rare: <input type="checkbox" class="checkbox" checked/></li>
            <li name="medium" id="medium" class="medium">medium: <input type="checkbox" class="checkbox" checked/></li><br />
           <li name="mediumWellDone" id="mediumWellDone" class="mediumWellDone">medium well done: <input type="checkbox" class="checkbox" checked/></li>
           <li name="wellDone" id="wellDone" class="wellDone">well done: <input type="checkbox" class="checkbox" checked/></li>
        </ul>
    </div>
</div>

<!-- The Modal -->
<div id="burgerModal" class="modal">
    <!-- Modal content -->
    <div id="burgerContent" class="modal-content">
        <span class="close2"></span>
        <h3>Burger with toppings of your choice</h3>
        <ul id="toppingsList" class="toppingsList">
            <h4>Toppings: </h4><br />
            <li name="Lettuce" id="Lettuce" class="Lettuce">Lettuce: <input type="checkbox" class="checkbox" checked/>
            </li>
            <li name="Tomato" id="Tomato" class="Tomato">Tomato: <input type="checkbox" class="checkbox" checked/></li>
            <li name="Mushroom" id="Mushroom" class="Mushroom">Mushroom: <input type="checkbox" class="checkbox" checked/>
            </li>
            <li name="Onions" id="Onions" class="Onions">Onions: <input type="checkbox" class="checkbox" checked/></li><br />
            <li name="Bacon" id="Bacon" class="Bacon">Bacon: <input type="checkbox" class="checkbox" checked/></li>
            <li name="Cheese" id="Cheese" class="Cheese">Cheese: <input type="checkbox" class="checkbox" checked/></li>
            <li name="Ketchup" id="Ketchup" class="Ketchup">Ketchup: <input type="checkbox" class="checkbox" checked/></li>
            <li name="Mayonnaise" id="Mayonnaise" class="Mayonnaise">Mayonnaise: <input type="checkbox" class="checkbox" checked/></li>
        </ul>
    </div>
</div>

<!-- Trigger/Open The Modal -->
<!--  <button type="button" id="myBtn">Open Modal</button>-->

<!-- The Modal -->
<div id="pizzaModal" class="modal">
    <!-- Modal content -->
    <div id="pizzaContent" class="modal-content">
        <span class="close">&times;</span>
		<h3>Pizza with toppings of your choice</h3><br />
        <p style="float: right;">Size:
        <select size="1">
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
            <option value="xLarge">X-Large</option>
        </select> </p>
        <ul id="toppingsList" class="toppingsList">
            <h4>Toppings: </h4><br />
            <li name="Mushrooms" id="Mushrooms" class="Mushrooms">Mushrooms: <input type="checkbox" class="checkbox"/>
            </li>
            <li name="Onions" id="Onions" class="Onions">Onions: <input type="checkbox" class="checkbox"/></li>
            <li name="Pepperoni" id="Pepperoni" class="Pepperoni">Pepperoni: <input type="checkbox" class="checkbox"/>
            </li>
            <li name="Olives" id="Olives" class="Olives">Olives: <input type="checkbox" class="checkbox"/></li>
        </ul>
    </div>
</div>

<?php
?>

<script>
    //modal
    var pizzaModal = document.getElementById('pizzaModal');
    var burgerModal = document.getElementById('burgerModal');
    var steakModal = document.getElementById('steakModal');
    
    var close = document.getElementsByClassName("close")[0];
    var burgerSpan = document.getElementsByClassName("close2")[0];
    var steakSpan = document.getElementsByClassName("close3")[0];

    var pizzaImg = document.getElementById('pizzaImg');
    var burgerImg = document.getElementById('burgerImg');
    var steakImg = document.getElementById('steakImg');

    //open when pizza image is clicked
    pizzaImg.onclick = function () {
        pizzaModal.style.display = "block";
    }

    //open when burger image is clicked
    burgerImg.onclick = function () {
        burgerModal.style.display = "block";
    }

    //open when burger image is clicked
    steakImg.onclick = function () {
        steakModal.style.display = "block";
    }

    //close on X
    close.onclick = function () {
        pizzaModal.style.display = "none";
    }

    burgerSpan.onclick = function () {
        burgerModal.style.display = "none";
    }

    //close modal when clicked outside
    window.onclick = function (event) {
        if (event.target == pizzaModal || event.target == burgerModal || event.target == steakModal) {
            pizzaModal.style.display = "none";
            burgerModal.style.display = "none";
            steakModal.style.display = "none";
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
