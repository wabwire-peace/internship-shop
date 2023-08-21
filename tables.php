<?php
include("db.inc.php");

$create_orders_table = "
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    billing_first_name VARCHAR(50),
    billing_last_name VARCHAR(50),
    billing_street VARCHAR(100),
    billing_province VARCHAR(50),
    billing_country VARCHAR(50),
    shipping_first_name VARCHAR(50),
    shipping_last_name VARCHAR(50),
    shipping_street VARCHAR(100),
    shipping_province VARCHAR(50),
    shipping_country VARCHAR(50)
)";

$create_order_items_table = "
CREATE TABLE order_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_name VARCHAR(100),
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
)";

if ($conn->query($create_orders_table) === TRUE && $conn->query($create_order_items_table) === TRUE) {
    echo "Tables created successfully.";
} else {
    echo "Error creating tables: " . $conn->error;
}

$conn->close();
?>