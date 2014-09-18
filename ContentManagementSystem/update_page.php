<?php

// Check if user is logged in, if not, redirect to login page
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.htm');
    exit();
} else {
    // Store the inputs as variables
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];

    $ok = true;

    // Check to make sure that no field is empty
    if (empty($title)) {
        echo 'A title is required for the webpage <br />';
        $ok = false;
    }
    if (trim($content) == "") {
        echo 'Content is required for the webpage <br />';
        $ok = false;
    }
    
    if ($ok == true) {
        try {
            //connect to DB
            $conn = new PDO('mysql:host=webdesign4;dbname=db200260568', 'db200260568', '70707');

            // Turn on error reporting
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Create the SQL
            $sql = "UPDATE assignment2_pages SET
                    title = :title, 
                    content = :content 
                    WHERE pageID = :id";
            
            // Prepare the SQL
            $cmd = $conn->prepare($sql);
            
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $content, PDO::PARAM_LOB);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Execute the SQL
            $cmd->execute();
            
            // Disconnect from the database
            $conn = null;
            
            // Redirect to the web pages table
            header('Location: web_page_panel.php');
        }
        // Catch exceptions
        catch (PDOException $pe) {
            mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
        } catch (exception $e) {
            mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
        }
    }
}
?>
