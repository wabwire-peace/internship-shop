<style>
    .buttons{
        width:382px;
        display:flex;
        justify-content: space-between;
    }
</style>
<body>
    <form action="cart.php" method="get">

    <table class="table table-striped">
    <!-- <table border='1'> -->
        <tr>
            <th>Product Name</th>
            <th>Product price</th>
            <th>Quantity</th>
            <th>Total</th>
            <!-- <th>Actions</th> -->
            <th>Remove</th>
        </tr>
        

        <?php
        include("header.php");          
         
        // var_dump($_GET['quantity']);  
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) {
            $productIdToDelete = $_GET['id'];
            if (isset($_SESSION['cart'][$productIdToDelete])) {
                unset($_SESSION['cart'][$productIdToDelete]);
            }
        }

        elseif (isset($_GET['action']) && $_GET['action'] === 'save' && isset($_GET['quantity']) && is_array($_GET['quantity'])) {
                $quantities = $_GET['quantity'];

               foreach ($_GET['quantity'] as $product_id => $quantity) {
                        if (is_numeric($product_id) && is_numeric($quantity)) {
                            $_SESSION['cart'][$product_id] = $quantity;
                        }
               }
        }
            
        elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {           
            $quantity=1;            


            if (isset($_GET['quantity']) && is_numeric($_GET['quantity'])) {
                $quantity=$_GET['quantity'];
            }

            if (isset($_SESSION['cart'][$_GET['id']])){
                $_SESSION['cart'][$_GET['id']]=$_SESSION['cart'][$_GET['id']]+ $quantity;
            
            } else {
                $_SESSION['cart'][$_GET['id']]=$quantity;
            }
        }            
        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $query = "SELECT * FROM products WHERE product_id='".$productId."'";
                $result = $conn->query($query);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total = $row['product_price'] * $quantity;
                        echo "<tr>";
                        echo '<td><a href="product.php?id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></td>';
                        echo "<td id='price_" . $row['product_id'] . "'>".$row['product_price']."</td>";
                        echo '<td>';
                        echo '<input type="number" name="quantity[' . $row['product_id'] . ']" id="quantity_' . $row['product_id'] . '"
                              value="' . $quantity . '" min="1" max="10">';
                        echo '</td>';
                        echo '<td id="total_price_' . $row['product_id'] . '">' . $total . '</td>';
                        // echo '<td>';
                        // // echo '<select name="quantity_' . $row['product_id'] . '" id="quantity_' . $row['product_id'] . '" onchange="updateTotalPrice(' . $row['product_id'] . ');">';
                        // // for ($i = 1; $i <= 10; $i++) {
                        // //     echo '<option value="' . $i . '"';
                        // //     if ($i == $quantity) {
                        // //         echo ' selected';
                        // //     }
                        // //     echo '>' . $i . '</option>';
                        // // }
                        // // echo '</select>';
                        // // echo '</td>';
                        // // echo "<td id='total_price_" . $row['product_id'] . "'>".$total."</td>";
                        echo '<td><a href="cart.php?action=delete&id=' . $row['product_id'] . '">Delete</a></td>';
                        echo "</tr>";
                           
                    }
                }             
            }
        } 

        else {
            echo "<tr><td>Your cart is empty.</td></tr>";
        }
        ?>

        
        
        </table>
    
        <br>

        <div class="buttons">
            <!-- <a href="checkout.php" >Proceed to Checkout</a> -->
            <!-- <a class="btn btn-primary disabled placeholder col-4" href="checkout.php" >Proceed to Checkout</a> -->
            <!-- <a class="nav-link" href="checkout.php">Proceed to Checkout</a> -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="checkout.php"><b>Proceed to Checkout</b></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Save Cart</a>
                </li> -->
            </ul>
            <!-- <form action="save_cart.php" method="post"> -->
            <!-- <input type="submit" name="save_cart" value="Save Cart">    -->
            <button type="submit" name="save_cart" value="Save Cart" class="btn btn-primary">Save Cart</button>';
            <input type="hidden" name="action" value="save">
            <!-- <button type='submit' name='save changes' >Save Changes</button> -->
            <!-- <a href="index.php" name='save changes'>Save Changes</a> -->
        </div>
    </form>

   
    <?php include("footer.php");?>


