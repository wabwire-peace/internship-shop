<?php
    include("header.php");
    echo '<br>';
       
    $query = "SELECT * FROM products LIMIT 10";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<div class="container">';
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
        
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col">';
            echo '<div class="card shadow-sm" style="height: 100%;">';
            echo '<img src="'.$row['product_image'].'" width="100%" height="450px"   alt="">';
            echo '<div class="card-body" style="display: flex; justify-content: flex-end; flex-direction: column;" >';
            echo '<h5 class="card-title">'.$row['product_name'].'</h5>';
            echo '<p class="card-text">'.$row['product_description'].'</p>';
            echo '<div class="d-flex justify-content-between align-items-center">';
            echo '<div class="btn-group">';
            echo '<form action="cart.php" method="GET">';
            echo '<input name="id" type="hidden" value="'.$row['product_id'].'"/>';
            //  echo '<button type="submit" class="btn btn-sm btn-outline-secondary add-to-cart-btn">Add to Cart</button>';
            echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
            echo '</form>';
            // echo '<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>';
            echo '</div>';
            echo '<small class="text-body-secondary"><b>'.$row['product_price'].'</b></small>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        
        echo '</div>'; 
        echo '</div>';
    }
    
    include("footer.php");
?>

<!-- <style>
    .image-container {
    position: relative;
    width: 100%;
    /* height: 400px; Adjust the height as needed */
    background-size: contain;
    background-position: center;
    margin-bottom: 20px; /* Adjust the margin between images as needed */
}

.card {
    background: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to the card */
    padding: 15px;
}

.add-to-cart-btn{
    color: white;
    background: black;
    padding: 10px 30px;
    border-radius: 20px;
}
</style> -->