<?php 

    include("header.php"); // The code is including the header.php file, which contains the HTML header and navigation

        $errors = array();
        $productId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
        $namePattern = "/^[a-zA-Z\s]+$/";
        $emailPattern = "/^.+@.+$/";

        $name = $_POST['name'];
        $email = $_POST['email'];

    if (empty($name)) {
        $errors["name"] = "Name is required";
    } elseif (!preg_match($namePattern, $name)) {
        $errors["name"] = "Name contains letters and spaces";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!preg_match($emailPattern, $email)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($errors)) {
        $productId = $_POST['product_id'];
        $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
        $status = false;

        $query = "INSERT INTO product_reviews (product_id, name, email, comment, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssi", $productId, $name, $email, $comment, $status);

    if ($stmt->execute()) {
            echo "Reviewed successfully!";
            
    } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    }

    if ($productId !== null) {
        $query = "SELECT * FROM products WHERE product_id='".$_GET['id']."'";
        $stmt = $conn->prepare($query);
        // $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

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
        echo "No products found.";
    }

    $stmt->close();
} else {
    echo "Product ID is not correct.";
}

$reviews = getReviewsForProduct($conn, $productId);

function getReviewsForProduct($conn, $productId) {
    $query = "SELECT * FROM product_reviews WHERE product_id=? AND status=1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }

    return $reviews;
}

$reviews = getReviewsForProduct($conn, $productId);
?>

<br>

<h1>Product Reviews</h1>
<?php if (isset($productId) && !empty($reviews)): ?>
    <ul>
     <?php foreach ($reviews as $review): ?>
            <li>
            <strong>Name:</strong> <?php echo htmlspecialchars($review['name']); ?><br>
            <strong>Comment:</strong> <?php echo htmlspecialchars($review['comment']); ?><br>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php else: ?>
    <p>No reviews for this product.</p>
    <?php endif; ?>

    <h2>Leave a Review</h2>
    <form action="product.php?id=<?php echo $productId;?>" method="post">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <label for="name">Name:</label><br>
        <input type="text" name="name" title="Name without numbers" ><br>
        <!-- <input type="text" name="name" required><br> -->
        <label for="email">Email:</label><br>
        <input type="email" name="email" ><br>
        <label for="comment">Comment:</label><br>
        <textarea name="comment" required></textarea><br>
        <button type="submit" name="submit_review" value="Submit Review" class="btn btn-primary">Submit Review</button>
        <input type="hidden" name="action" value="submit">
    </form>

<?php include("footer.php");?> <!-- I am including the footer.php external file to load some html-->


