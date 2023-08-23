<?php
    include("header.php"); // The code is including the header.php external file and load some html from it
   
    $query = "SELECT * FROM products LIMIT 10"; // I am building a query to retrieve the 10 products from the database
    $result = $conn->query($query); // I am executing the query

    if ($result->num_rows > 0) { // I am checking if there are any results returned by my query

        echo '<div class="container">'; // I am opening a container for the products
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">'; // I am creating a row with multiple columns
        
        while ($row = $result->fetch_assoc()) { // I am creating a loop through each product in the result
            echo '<div class="col">'; // I am creating a column for each product
            echo '<div class="card shadow-sm" style="height: 100%;">'; // I am creating a card for the product
            echo '<img src="'.$row['product_image'].'" width="100%" height="450px"   alt="">'; // The code is displaying the product image
            echo '<div class="card-body" style="display: flex; justify-content: space-between; flex-direction: column;" >'; // The code shows card body with flex layout
            echo '<h5 class="card-title"><a href="product.php?id='.$row['product_id'].'">'.$row['product_name'].'</a></h5>'; // I am displaying the product name as a link
            echo '<p class="card-text">'.$row['product_description'].'</p>'; // This is displaying the product description
            echo '<div class="d-flex justify-content-between align-items-center">'; // This is a flex layout for button and price
            echo '<div class="btn-group">'; // The code shows a button group for interaction options
            echo '<form action="cart.php" method="GET">'; // I am creating a form to handle adding to cart
            echo '<input name="id" type="hidden" value="'.$row['product_id'].'"/>'; // I am creating a hidden input to send the product ID
            echo '<button type="submit" class="btn btn-primary">Add to Cart</button>'; // I am creating a button to add the product to the cart
            echo '</form>'; // I am closing the form
            echo '</div>'; // I am closing the button group 
            echo '<small class="text-body-secondary"><b>'.$row['product_price'].' Lei</b></small>'; // The code is displaying the product price
            echo '</div>'; // I am closing the flex layout
            echo '</div>'; // I am closing the card body
            echo '</div>'; // I am closing the card
            echo '</div>'; // I am closing the column
        }
        
            echo '</div>';  // I am closing the row
            echo '</div>'; // This code is closing the container
    }
    
    include("footer.php"); // I am including the footer.php external file to load some html 
?>

