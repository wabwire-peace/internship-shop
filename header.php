<?php
      include("db.inc.php"); // The code is including a db.inc.php file that contains the database connection code

      session_start(); // I am starting a new session 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"><!-- I am putting a bootstrap link with style -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> <!-- I am putting a bootstrap script -->
</head>

<style>
  .me-2{
    padding: 10px 40px;
    border-radius: 10px;
    color: white;
    background: #1017e3;
    transition: transform 0.3s, background 0.3s;
    
  }
  .me-2:hover{
    background: #1017e3;
    transform: scale(1.1);
    
  }
</style>
<body>

<div class="container"> <!-- I am opening a container div to structure the page content -->
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom"> <!-- This is an opening header section with flex layout and alignment -->
      <div class="col-md-3 mb-2 mb-md-0">  <!-- This is div class for col to logo area -->
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none"> <!-- I am creating a link to homepage -->
          <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg> <!-- This is a SVG icon, possibly related to Bootstrap framework -->
        </a> <!-- This is a closing for a link to homepage -->
      </div> <!-- This is a closing div for the col to logo area -->

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0"> <!-- I am creating navigation menu -->
            <li><a href="index.php" class="nav-link px-2 link-secondary"><b>Products</b></a></li> <!-- I am creating a link to the Products -->
            <li><a href="page.php?id=1" class="nav-link px-2 link-secondary"><b>About Us</b></a></li><br>
      </ul>
            
      </ul>
      <div class="text-end">
          <a href="page.php?id=2" class="nav-link px-2 link-secondary"><b>Contact Us</b></a></div><br>
      <div class="col-md-3 text-end"> <!-- I am creating area on the right side of the header -->
        <a href="cart.php" class="btn btn-outline-primary me-2"><b>Cart</b></a> <!-- I am creating a link to the cart.php with a styled button -->
        
      </div> <!-- I am ending the div -->
    </header>  <!-- I am ending the header section -->


   
  

