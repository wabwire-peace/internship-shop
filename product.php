<?php 
include("header.php"); // The code is including the header.php file, which contains the HTML header and navigation

if (isset($_GET['id']) && is_numeric($_GET['id'])) { // I am checking if the parameter received from the request exists and is numeric 
    
    
    $query = "SELECT * FROM products WHERE product_id='".$_GET['id']."'"; // I am constructing a query to fetch product information based on the product_id received
    $result = $conn->query($query); //  I am executing the query using the database connection and storing the result

    if ($result->num_rows > 0) {  // I am checking if there are rows (products) returned from the database
        while ($row = $result->fetch_assoc()) { // I am looping through each row (product) in the result

         // I am displaying the product information within a container
            echo '<div class="container text-center"> 
                <div class="row">
                    <div class="col col-image">
                        <img src="' . $row['product_image'] . '" width="500" height="600" alt="Product Image" class="product-image">
                    </div>
                    <div class="col col-info">
                        <h1>' . $row['product_name'] . '</h1>
                        <div class="product-info">
                            <form action="cart.php" method="get">
                                <p><strong>Style:</strong> ' . $row['product_description'] . '</p>
                                <p><strong>SKU:</strong> ' . $row['sku'] . '</p>
                                <p><strong>Description:</strong> ' . $row['product_description'] . '</p>
                                <p><strong>Price:</strong> ' . $row['product_price'] . ' Lei</p>
                                <label for="quantity"><strong>Quantity:</strong></label>
                                <input type="number" id="quantity" name="quantity" value="1" min="1">
                                <input type="hidden" name="id" value="' . $row['product_id'] . '">
                                <button type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "No products found."; // I am displaying a message when there are no products found for the given id
    }
} else {
    echo 'product id is not correct.'; // I am displaying an error message when product id does not exist or is not a valid numeric value
}

include("footer.php"); // I am including the footer.php external file to load some html 
?>