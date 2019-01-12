<?php include('connect.php');

if (isset($_POST["add_to_cart"])) {

    if (isset($_SESSION["shoppingCart"])) {

        $count = count($_SESSION["shoppingCart"]);
        $product_ids = array();
        $product_ids = array_column($_SESSION['shoppingCart'], 'id');

        if (!in_array($_GET["id"], $product_ids)) {
            $_SESSION["shoppingCart"][$count] = array(
                'id' => $_GET["id"],
                'name' => $_POST["name"],
                'price' => $_POST["price"],
                'quantity' => $_POST["quantity"]
            );
        } else {//if product exists, increase quantity
            for ($i = 0; $i < count($product_ids); $i++) {
                if ($product_ids[$i] == $_GET["id"]) {
                    $_SESSION['shoppingCart'][$i]['quantity'] += $_POST["quantity"];
                }
            }
        }
    } else {
        //if no data in shopping cart, store these variables in item_array.
        //Store in shopping cart store in index 0, all info into this shopping cart
        $_SESSION["shoppingCart"][0] = array(
            'id' => $_GET["id"],
            'name' => $_POST["name"],
            'price' => $_POST["price"],
            'quantity' => $_POST["quantity"]
        );
    }
}

//pre_r($_SESSION);

function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {

        //loop all until matched with id
        foreach ($_SESSION["shoppingCart"] as $keys => $product) {
            if ($product["id"] == $_GET["id"]) {

                //remove product when matched with id
                unset($_SESSION["shoppingCart"][$keys]);

                //echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="menu.php"</script>';
            }
        }
        //reset session array keys so they match with $product_ids numeric array
        $_SESSION['shoppingCart'] = array_values($_SESSION['shoppingCart']);
    }
}

?>
