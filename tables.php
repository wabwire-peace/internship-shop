<?php
include("db.inc.php"); // The code is including a db.inc.php file that contains the database connection code

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

if ($conn->query($create_orders_table) === TRUE && $conn->query($create_order_items_table) === TRUE) { // I am executing the create tables queries and checking whether it is working
    echo "Tables created successfully.";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close(); // I am closing the database connection
?>