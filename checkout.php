 <?php

    include("header.php");  // The code is including the header.php external file and load some html from it

    // The code initialize variables for billing information
    $billing_first_name = "";
    $billing_last_name = "";
    $billing_email = "";
    $billing_address = "";
    $billing_country = "";
    $billing_state = "";
    $billing_zip = "";

    // The code initialize variables for shipping information
    $shipping_first_name = "";
    $shipping_last_name = "";
    $shipping_email = "";
    $shipping_address = "";
    $shipping_country = "";
    $shipping_state = "";
    $shipping_zip = "";

    $errors = []; // The code initialize errors array

    if (isset($_POST['checkout'])) { // Initialize an array to store validation errors
        $errors = [];

        // The code define regex patterns for validation
        $namePattern = "/^[a-zA-Z\s]+$/";
        $emailPattern = "/^.+@.+$/";
        $zipPattern = "/^[a-zA-Z0-9\s]+$/";
        $provinceCountryPattern = "/^[a-zA-Z\s]+$/";

        //This code retrieve billing information from POST data
        $billing_first_name = $_POST['billing_first_name'];
        $billing_last_name = $_POST['billing_last_name'];
        $billing_email = $_POST['billing_email'];
        $billing_address = $_POST['billing_address'];
        $billing_country = $_POST['billing_country'];
        $billing_state = $_POST['billing_state'];
        $billing_zip = $_POST['billing_zip'];

        //This code retrieve billing information from POST data
        $shipping_first_name = $_POST['shipping_first_name'];
        $shipping_last_name = $_POST['shipping_last_name'];
        $shipping_email = $_POST['shipping_email'];
        $shipping_address = $_POST['shipping_address'];
        $shipping_country = $_POST['shipping_country'];
        $shipping_state = $_POST['shipping_state'];
        $shipping_zip = $_POST['shipping_zip'];
        
        //This code is validate billing information
        if (!preg_match($emailPattern, $billing_email)) {
            $errors["billing_email"] = "Billing Email should contain @";
        }
        if (empty($billing_email)) {
            $errors["billing_email"] = "Billing email is required";
        }

        if (!preg_match($namePattern, $billing_first_name)) {
            $errors["billing_first_name"] = "Billing First Name without numbers";
        }

        if (empty($billing_first_name)) {
            $errors["billing_first_name"] = "Billing First Name is required";
        }

        if (!preg_match($namePattern, $billing_last_name)) {
            $errors["billing_last_name"] = "Billing Last Name without numbers";
        }

        if (empty($billing_last_name)) {
            $errors["billing_last_name"] = "Billing Last Name is required";
        }

        if (!preg_match($provinceCountryPattern, $billing_country)) {
            $errors["billing_country"] = "Billing Country without numbers";
        }

        if (empty($billing_country)) {
            $errors["billing_country"] = "Billing Country is required";
        }

        if (!preg_match($namePattern, $billing_address)) {
            $errors["billing_address"] = "Billing Address without numbers";
        }
        if (empty($billing_address)) {
            $errors["billing_address"] = "Billing Address is required";
        }

        if (!preg_match($namePattern, $billing_state)) {
            $errors["billing_state"] = "Billing State without numbers";
        }
        if (empty($billing_state)) {
            $errors["billing_state"] = "Billing State is required";
        }

        if (!preg_match($zipPattern, $billing_zip)) {
            $errors["billing_zip"] = "Billing Zip with numbers";
        }
        if (empty($billing_state)) {
            $errors["billing_state"] = "Billing Zip is required";
        }

        if (!preg_match($namePattern, $shipping_first_name)) {
            $errors["shipping_first_name"] = "Shipping First Name without numbers";
        }

        if (empty($shipping_first_name)) {
            $errors["shipping_first_name"] = "Shipping First Name is required";
        }

        if (!preg_match($namePattern, $shipping_last_name)) {
            $errors["shipping_last_name"] = "Shipping Last Name without numbers";
        }
        
        if (empty($shipping_last_name)) {
            $errors["shipping_last_name"] = "Shipping Last Name is required";
        }

        if (!preg_match($provinceCountryPattern, $shipping_country)) {
            $errors["shipping_country"] = "Shipping Country without numbers";
        }                

        if (empty($shipping_country)) {
            $errors["shipping_country"] = "Shipping Country is required";
        }

        if (!preg_match($emailPattern, $shipping_email)) {
            $errors["shipping_email"] = "Shipping Email with @";
        }              

        if (empty($shipping_email)) {
            $errors["shipping_email"] = "shipping email is required";
        }

        if (!preg_match($namePattern, $shipping_address)) {
            $errors["shipping_address"] = "shipping Address without numbers";
        }

        if (empty($shipping_address)) {
            $errors["shipping_address"] = "shipping Address is required";
        }

        if (!preg_match($namePattern, $shipping_state)) {
            $errors["shipping_state"] = "shipping State without numbers";
        }
        
        if (empty($shipping_state)) {
            $errors["shipping_state"] = "Shipping State is required";
        }

        if (!preg_match($zipPattern, $shipping_zip)) {
            $errors["shipping_zip"] = "shipping Zip with numbers";
        }
        if (empty($shipping_zip)) {
            $errors["shipping_zip"] = "shipping Zip is required";
        }


        if (!$errors) { // If there are no validation errors, proceed to insert the order into the database


                // SQL query to insert order details into the "orders" table
                $insert_order_query = "INSERT INTO orders (billing_first_name, billing_last_name, billing_email, billing_address, billing_state, billing_country, billing_zip, shipping_first_name, shipping_last_name, shipping_email, shipping_address, shipping_country, shipping_state, shipping_zip) VALUES ('$billing_first_name', '$billing_last_name', '$billing_email', '$billing_address', '$billing_country', '$billing_state', '$billing_zip', '$shipping_first_name', '$shipping_last_name', '$shipping_email', '$shipping_address', '$shipping_country', '$shipping_state', '$shipping_zip')";

                // Execute the order insertion query
                if ($conn->query($insert_order_query) === TRUE) {
                    $order_id = $conn->insert_id;

                    var_dump($_SESSION); // Debugging: Display session data

                    // Process each product in the cart
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                            $query = "SELECT * FROM products WHERE product_id = '$product_id'";
                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                $product = $result->fetch_assoc();
                                $price = $product['product_price'];

                                $insert_item_query = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";

                                if ($conn->query($insert_item_query) === TRUE) {
                                    echo "Item added to order: {$product['product_name']} ($quantity x $price)<br>";
                                } else {
                                    echo "Error inserting item: " . $conn->error;
                                }
                            }
                            
                        }
                                               
                        $_SESSION['cart'] = array(); // Clear the cart

                        echo "Order placed successfully!";

                        header("Location: index.php"); // Redirect to the homepage
                        
                        exit(); 

                
                        } else {
                                echo "Error inserting order: " . $conn->error;
                            }
                            $stmt->close();
                        }
                    }
         
            } else {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
            }

    ?>
<!-- HTML content for the main page including Billing adress and Shipping adress -->
<main>
    <div class="container">
 
    <div class="row g-5">

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate="" method="post">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" name="billing_first_name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="billing_first_name" value="<?php echo $billing_first_name; ?>" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="billing_last_name" value="<?php echo $billing_last_name; ?>" required="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="billing_email" placeholder="you@example.com" value="<?php echo $billing_email; ?>">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="billing_address" placeholder="1234 Main St" required="" value="<?php echo $billing_address; ?>">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="billing_country" placeholder="Country" required="" value="<?php echo $billing_country; ?>">
                            <div class="invalid-feedback">
                                Please enter a valid country.
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="billing_state" placeholder="State" required="" value="<?php echo $billing_state; ?>">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="billing_zip" placeholder="" required="" value="<?php echo $billing_zip; ?>">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>


                    <br>
                    <br>
                    <br>
                
                <h4 class="mb-3">Shipping address</h4>
                
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="shipping_first_name" value="<?php echo $shipping_first_name; ?>" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="shipping_last_name" value="<?php echo $shipping_last_name; ?>" required="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="shipping_email" placeholder="you@example.com" value="<?php echo $shipping_email; ?>">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>


                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="shipping_address" placeholder="1234 Main St" required="" value="<?php echo $shipping_address; ?>">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" name="shipping_country" placeholder="Country" required="" value="<?php echo $shipping_country; ?>">
                            <div class="invalid-feedback">
                                Please enter a valid country.
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="shipping_state" placeholder="State" required="" value="<?php echo $shipping_state; ?>">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="shipping_zip" placeholder="" required="" value="<?php echo $shipping_zip; ?>">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>


                    <br>
                    <button class="w-100 btn btn-primary btn-lg" type="submit" name="checkout">Place Order</button>
                </form> <!-- I am closing the column -->
            </div> <!-- I am closing the column -->
        </div> <!-- I am closing the column -->
     </div> <!-- I am closing the column -->

    
 </main>

 <?php include("footer.php"); ?> <!-- I am including the footer.php external file to load some html -->