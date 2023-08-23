<?php
    include("header.php");?>  <!--The code is including the header.php external file and load some html from it-->

    <form action="cart.php" method="get">

    <table class="table table-striped">
        
            <tr>
            <th>Product Name</th>
            <th>Product price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
        </tr>

    <?php
           
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && is_numeric($_GET['id'])) { // I am checking if 'action' is set to 'delete' and 'id' is set and is a numeric value
            $productIdToDelete = $_GET['id'];  // I am retrieving the product ID to delete
            if (isset($_SESSION['cart'][$productIdToDelete])) { // I am checking if the product exists in the cart and remove it
                unset($_SESSION['cart'][$productIdToDelete]);
            }
        }

        elseif (isset($_GET['action']) && $_GET['action'] === 'save' && isset($_GET['quantity']) && is_array($_GET['quantity'])) { // I am checking if 'action' is set to 'save', 'quantity' is set, and it's an array
                $quantities = $_GET['quantity']; // I am retrieving quantities from the form

               foreach ($_GET['quantity'] as $product_id => $quantity) { // I am looping through quantities and update the cart session with new values
                        if (is_numeric($product_id) && is_numeric($quantity)) {
                            $_SESSION['cart'][$product_id] = $quantity;
                        }
               }
        }
            
        elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {  // I am checking if 'id' is set and is a numeric value         
            $quantity=1;            


            if (isset($_GET['quantity']) && is_numeric($_GET['quantity'])) { // I am checking if 'quantity' is set and is a numeric value
                $quantity=$_GET['quantity'];
            }

            if (isset($_SESSION['cart'][$_GET['id']])){ // I am checking cart session with the quantity for the product
                $_SESSION['cart'][$_GET['id']]=$_SESSION['cart'][$_GET['id']]+ $quantity;
            
            } else {
                $_SESSION['cart'][$_GET['id']]=$quantity;
            }
        }            
        
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { // I am checking if there are products in the cart session
            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $query = "SELECT * FROM products WHERE product_id='".$productId."'"; // I am creating a query database to fetch product information based on the product ID
                $result = $conn->query($query); //  I am executing the query using the database connection and storing the result
            
                if ($result->num_rows > 0) { // I am checking if there are rows (products) returned from the database
                    while ($row = $result->fetch_assoc()) { // I am looping through each row (product) in the result
                        $total = $row['product_price'] * $quantity;
                        echo "<tr>";
                        echo '<td><a href="product.php?id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></td>'; 
                        echo "<td id='price_" . $row['product_id'] . "'>".$row['product_price']."</td>";
                        echo '<td>';
                        echo '<input type="number" name="quantity[' . $row['product_id'] . ']" id="quantity_' . $row['product_id'] . '"
                              value="' . $quantity . '" min="1" max="10">';
                        echo '</td>';
                        echo '<td id="total_price_' . $row['product_id'] . '">' . $total . '</td>';
                        echo '<td><a href="cart.php?action=delete&id=' . $row['product_id'] . '">Delete</a></td>';
                        echo "</tr>";
                           
                    }
                }             
            }
        } 

        else {
            echo "<tr><td><b>Your cart is empty.</b></td></tr>";  // I am displaying a message if the cart is empty
        }
        ?>        
        
        </table>
    
        <br>

        <div class="buttons">
          
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="checkout.php"><b>Proceed to Checkout</b></a>
                </li>

                <li class="nav-item">
                    <button type="submit" name="save_cart" value="Save Cart" class="btn btn-primary">Save Cart</button>
                </li>
                
            </ul>            
            
            <input type="hidden" name="action" value="save"> <!-- I am putting a hidden input to indicate the action is 'save' when submitting the form -->
            
        </div>
    </form>

   
    <?php include("footer.php");?> <!--I am including the footer.php external file to load some html-->


