    <?php 
    include("header.php");
    echo "<br>";

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $productId = $_GET['id'];
        $query = "SELECT * FROM products WHERE product_id = $productId";
        $result = $conn->query($query);   

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>" . $row['product_name'] . "</h1>";
            echo "<img src='" . $row['product_image'] . "' alt='Product Image' width='200'>";
            echo "<p>SKU: " . $row['sku'] . "</p>";
            echo "<p>Description: " . $row['product_description'] . "</p>";
            echo "<p>Price: $" . $row['product_price'] . "</p>";
            echo "<form action='cart.php' method='get'>";
            echo "<label for='quantity'>Quantity:</label>";
            echo "<input type='number' id='quantity' name='quantity' value='1' min='1'>";
            echo "<input type='hidden' name='id' value='" . $row['product_id'] . "'>";
            echo "<button type='submit' name='add_to_cart'>Add to Cart</button>";
            echo "</form>";
        } else {
            echo "Product not found.";
        }
    } else {
        echo "<table border = '1'>";        
        echo "<tr>";                       
        echo "<th>Product Name</th>";
        echo "<tr>";
        echo "<td>Blouse:</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Tshirt: </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Trouser: </td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Dress: </td>";        
        echo "</tr>";
        echo "<tr>";
        echo "<td>Jacket: </td>";
        echo "</tr>";
        echo "</table>";

        echo "<br>";

        echo '<a href="cart.php" id="cart">Go to Cart</a>';

        echo "<br>";
    }

    // mysqli_close($conn);

    include("footer.php");
    ?>

    <main>
  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
      <h1 class="display-3 fw-bold">Designed for engineers</h1>
      <h3 class="fw-normal text-muted mb-3">Build anything you want with Aperture</h3>
      <div class="d-flex gap-3 justify-content-center lead fw-normal">
        <a class="icon-link" href="#">
          Learn more
          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
        </a>
        <a class="icon-link" href="#">
          Buy
          <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
        </a>
      </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="text-bg-dark me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body-tertiary shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="text-bg-primary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body-tertiary shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
  </div>

  <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 p-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
    <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
      <div class="my-3 py-3">
        <h2 class="display-5">Another headline</h2>
        <p class="lead">And an even wittier subheading.</p>
      </div>
      <div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
    </div>
  </div>
</main>
   
     
    

