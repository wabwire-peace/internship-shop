 <?php

    include("header.php");


    // $billing_street = "";
    // $billing_province = "";
    // $billing_country = "";


    // $shipping_street = "";   
    // $shipping_province = "";
    // $shipping_country = "";


    $billing_first_name = "";
    $billing_last_name = "";
    $billing_email = "";
    $billing_address = "";
    // $billing_address2 = "";
    $billing_country = "";
    $billing_state = "";
    $billing_zip = "";


    $shipping_first_name = "";
    $shipping_last_name = "";
    $shipping_email = "";
    $shipping_address = "";
    // $shipping_address2 = "";
    $shipping_country = "";
    $shipping_state = "";
    $shipping_zip = "";

    $errors = [];

    if (isset($_POST['checkout'])) {
        $errors = [];
        $namePattern = "/^[a-zA-Z]+$/";
        $provinceCountryPattern = "/^[a-zA-Z\s]+$/";
        $billing_first_name = $_POST['billing_first_name'];
        $billing_last_name = $_POST['billing_last_name'];
        $billing_email = $_POST['billing_email'];
        $billing_address = $_POST['billing_adress'];
        $billing_state = $_POST['billing_state'];
        $billing_zip = $_POST['billing_zip'];
        // $billing_street = $_POST['billing_street'];
        // $billing_province = $_POST['billing_province'];
        // $billing_country = $_POST['billing_country'];

        $shipping_first_name = $_POST['shipping_first_name'];
        $shipping_last_name = $_POST['shipping_last_name'];
        $shipping_email = $_POST['shipping_email'];
        $shipping_address = $_POST['shipping_adress'];
        $shipping_state = $_POST['shipping_state'];
        $shipping_zip = $_POST['shipping_zip'];
        // $shipping_street = $_POST['shipping_street'];
        // $shipping_province = $_POST['shipping_province'];
        // $shipping_country = $_POST['shipping_country'];

            
        if (!preg_match($namePattern, $billing_email)) {
        $errors["billing_email"] = "Billing Email with @";
        }
        if (empty($billing_email)) {
        $errors["billing_email"] = "Billing email is required";
        }

        if (!preg_match($namePattern, $billing_first_name)) {
            $errors["billing_first_name"] = "Billing First Name without numbers";
        }

        if (!preg_match($namePattern, $billing_last_name)) {
            $errors["billing_last_name"] = "Billing Last Name without numbers";
        }

        if (!preg_match($namePattern, $shipping_first_name)) {
            $errors["shipping_first_name"] = "Shipping First Name without numbers";
        }

        if (!preg_match($namePattern, $shipping_last_name)) {
            $errors["shipping_last_name"] = "Shipping Last Name without numbers";
        }

        // if (!preg_match($provinceCountryPattern, $billing_province)) {
        //     $errors["billing_province"] = "Billing Province without numbers";
        // }

        if (!preg_match($provinceCountryPattern, $billing_country)) {
            $errors["billing_country"] = "Billing Country without numbers";
        }

        // if (!preg_match($provinceCountryPattern, $shipping_province)) {
        //     $errors["shipping_province"] = "Shipping Province without numbers";
        // }

        if (!preg_match($provinceCountryPattern, $shipping_country)) {
            $errors["shipping_country"] = "Shipping Country without numbers";
        }

        if (empty($billing_first_name)) {
            $errors["billing_first_name"] = "Billing First Name is required";
        }

        if (empty($billing_last_name)) {
            $errors["billing_last_name"] = "Billing Last Name is required";
        }

        // if (empty($billing_street)) {
        //     $errors["billing_street"] = "Billing Street is required";
        // }

        // if (empty($billing_province)) {
        //     $errors["billing_province"] = "Billing Province is required";
        // }

        if (empty($billing_country)) {
            $errors["billing_country"] = "Billing Country is required";
        }

        if (empty($shipping_first_name)) {
            $errors["shipping_first_name"] = "Shipping First Name is required";
        }

        if (empty($shipping_last_name)) {
            $errors["shipping_last_name"] = "Shipping Last Name is required";
        }

        // if (empty($shipping_street)) {
        //     $errors["shipping_street"] = "Shipping Street is required";
        // }

        // if (empty($shipping_province)) {
        //     $errors["shipping_province"] = "Shipping Province is required";
        // }

        if (empty($shipping_country)) {
            $errors["shipping_country"] = "Shipping Country is required";
        }

        if (!preg_match($namePattern, $billing_email)) {
            $errors["billing_email"] = "Billing Email with @";
        }
        if (empty($billing_first_name)) {
            $errors["billing_first_name"] = "Billing email is required";
        }


        if (!preg_match($namePattern, $billing_address)) {
            $errors["billing_address"] = "Billing Adress without numbers";
        }
        if (empty($billing_address)) {
            $errors["billing_address"] = "Billing Adress is required";
        }

        if (!preg_match($namePattern, $billing_state)) {
            $errors["billing_state"] = "Billing State without numbers";
        }
        if (empty($billing_state)) {
            $errors["billing_state"] = "Billing State is required";
        }

        if (!preg_match($namePattern, $billing_zip)) {
            $errors["billing_zip"] = "Billing State with numbers";
        }
        if (empty($billing_state)) {
            $errors["billing_state"] = "Billing Zip is required";
        }

        

        if (!preg_match($namePattern, $shipping_email)) {
            $errors["shipping_email"] = "shipping Email with @";
        }
        if (empty($shipping_first_name)) {
            $errors["shipping_first_name"] = "shipping email is required";
        }


        if (!preg_match($namePattern, $shipping_address)) {
            $errors["shipping_address"] = "shipping Adress without numbers";
        }
        if (empty($billing_address)) {
            $errors["shipping_address"] = "shipping Adress is required";
        }

        if (!preg_match($namePattern, $shipping_state)) {
            $errors["shipping_state"] = "shipping State without numbers";
        }
        if (empty($billing_state)) {
            $errors["billing_state"] = "Billing State is required";
        }

        if (!preg_match($namePattern, $shipping_zip)) {
            $errors["shipping_zip"] = "shipping State with numbers";
        }
        if (empty($shipping_state)) {
            $errors["shipping_state"] = "shipping Zip is required";
        }


        if (!$errors) {

            $stmt = $conn->prepare("INSERT INTO orders (billing_first_name, billing_last_name, billing_email, billing_address, billing_state, billing_zip, shipping_first_name, shipping_last_name, shipping_email, shipping_address, shipping_country, shipping_state, shipping_zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssssss", $billing_first_name, $billing_last_name, $billing_email, $billing_address, $billing_state, $billing_zip, $shipping_first_name, $shipping_last_name, $shipping_email, $shipping_address, $shipping_country, $shipping_state, $shipping_zip);

            if ($stmt->execute()) {
                $order_id = $stmt->insert_id;



                //$insert_order_query = "INSERT INTO orders (billing_first_name, billing_last_name, billing_street, billing_province, billing_country, shipping_first_name, shipping_last_name, shipping_street, shipping_province, shipping_country) VALUES ('$billing_first_name', '$billing_last_name', '$billing_street', '$billing_province', '$billing_country', '$shipping_first_name', '$shipping_last_name', '$shipping_street', '$shipping_province', '$shipping_country')";
                $insert_order_query = "INSERT INTO orders (billing_first_name, billing_last_name, billing_email, billing_address, billing_state, billing_zip, shipping_first_name, shipping_last_name, shipping_email, shipping_address, shipping_country, shipping_state, shipping_zip) VALUES ('$billing_first_name', '$billing_last_name', '$billing_email', '$billing_address', '$billing_state', '$billing_zip', '$shipping_first_name', '$shipping_last_name', '$shipping_email', '$shipping_address', '$shipping_country', '$shipping_state', '$shipping_zip')";

                if ($conn->query($insert_order_query) === TRUE) {
                    $order_id = $conn->insert_id;

                    var_dump($_SESSION);

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
                            // else {
                            //     echo "Product not found for product ID: $product_id<br>";
                            // }
                        }
                        // die();
                        
                        $_SESSION['cart'] = array();

                        echo "Order placed successfully!";

                        header("Location: index.php");
                        
                        exit(); 

                
                        } else {
                                echo "Error inserting order: " . $conn->error;
                            }
                            $stmt->close();
                        }
                    }
        //                 $_SESSION['cart'] = array();

        //                 echo "Order placed successfully!";

        //                 header("Location: index.php");
        //                 exit();
        //             }
        //         }
        //     }
        // } 
            } else {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
            }

    }

    // $conn->close();
    ?>

 <!-- <form class="checkout" action="checkout.php" method="post">

     <h2>Billing Address</h2>

     <input type="text" name="billing_first_name" placeholder="First Name:" value="<?php echo $billing_first_name; ?>"><br>
     <input type="text" name="billing_last_name" placeholder="Last Name:" value="<?php echo $billing_last_name; ?>"><br>
     <input type="text" name="billing_street" placeholder="Street:" value="<?php echo $billing_street; ?>"><br>
     <input type="text" name="billing_province" placeholder="Province:" value="<?php echo $billing_province; ?>"><br>
     <input type="text" name="billing_country" placeholder="Country:" value="<?php echo $billing_country; ?>"><br>

     <h2>Shipping Address</h2>

     <input type="text" name="shipping_first_name" placeholder="First Name:" value="<?php echo $shipping_first_name; ?>"><br>
     <input type="text" name="shipping_last_name" placeholder="Last Name:" value="<?php echo $shipping_last_name; ?>"><br>
     <input type="text" name="shipping_street" placeholder="Street:" value="<?php echo $shipping_street; ?>"><br>
     <input type="text" name="shipping_province" placeholder="Province:" value="<?php echo $shipping_province; ?>"><br>
     <input type="text" name="shipping_country" placeholder="Country:" value="<?php echo $shipping_country; ?>"><br>

     <br>
     <button type="submit" name="checkout" class="submit">Place Order</button>
     <hr>
 </form> -->

 <main>
    <div class="container">
 
        <!-- <div class="py-5 text-center">

            <h2>Checkout form</h2>

        </div> -->

        <div class="row g-5">

            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate="">
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

                        <!-- <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite" value="<?php echo $billing_address; ?>">
                        </div> -->

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

                        <!-- <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite" value="<?php echo $shipping_address; ?>">
                        </div> -->

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
                </form>
            </div>
        </div>
    </div>

    
 </main>

 <?php include("footer.php"); ?>