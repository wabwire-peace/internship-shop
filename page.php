<?php

    include("header.php"); // The code is including the header.php file, which contains the HTML header and navigation

        // Get the 'id' parameter from the URL
        $id = $_GET['id'] ?? null;

        // Check if 'id' is provided in the URL
        if ($id !== null) {
            // Establish a database connection (assuming you have this code elsewhere)
        $conn = new mysqli("localhost", "root", "", "internship");

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
            // Prepare and execute a query to fetch the page by its ID
            $query = "SELECT title, content FROM pages WHERE id =?";
            $stmt = $conn->prepare($query);

            if ($stmt) { // Check if the prepare was successful
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                // Fetch the row
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $title = $row['title'];
                    $content = $row['content'];
                } else {
                    $title = "Page not found";
                    $content = "The requested page does not exist.";
                }
        
                // Close the statement
                $stmt->close();
            } else {
                $title = "Error";
                $content = "An error occurred while preparing the query.";
            }
        } else {
            $title = "Error";
            $content = "No page ID provided.";
        }
        
        if (isset($_POST['form_submit'])) {
            if (isset($_POST['message'])) {
                $to = 'wabwire.peace@osf.digital';
                $subject = 'New order created';
                $message = 'Message: ' . $_POST['message'];
        
                $headers = "From: radugabriel78@yahoo.com\r\n";
                $headers .= "Reply-To: radugabriel78@yahoo.com\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
                if (mail($to, $subject, $message, $headers)) {
                    echo "Email sent successfully!";
                } else {
                    echo "Email sending failed.";
                }
            } else {
                echo "No message provided.";
            }
        }           

?>

    <title><?php echo $title; ?></title>

    <h1><?php echo $title; ?></h1>
    <div><?php echo $content; ?></div>

<?php include("footer.php"); ?> <!-- I am including the footer.php external file to load some html -->