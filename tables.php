<?php
include("header.php");  // The code is including the header.php external file and load some html from it

// I am creating the 'orders' table

$create_orders_table = " 
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    billing_first_name VARCHAR(255),
    billing_last_name VARCHAR(255),
    billing_email VARCHAR(255),
    billing_address VARCHAR(255),
    billing_state VARCHAR(255),
    billing_country VARCHAR(255),
    billing_zip VARCHAR(20),
    shipping_first_name VARCHAR(255),
    shipping_last_name VARCHAR(255),
    shipping_email VARCHAR(255),
    shipping_address VARCHAR(255),
    shipping_state VARCHAR(255),
    shipping_country VARCHAR(255),
    shipping_zip VARCHAR(20)
)";

// I am creating the 'order_items' table

$create_order_items_table = "
CREATE TABLE order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_name VARCHAR(100),
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
)";

// I am creating the pages
$create_pages_table = "
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($create_orders_table) === TRUE && $conn->query($create_order_items_table) === TRUE && $conn->query($create_pages_table) === TRUE) { // I am executing the create tables queries and checking whether it is working
    echo "Tables created successfully.";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close(); // I am closing the database connection

 include("footer.php");   // I am including the footer.php external file to load some html 
?>