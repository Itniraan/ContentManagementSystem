<?php

/**
 * PHP to validate all info for a new webpage, and PHP to insert 
 * webpage into the database
 */
//Store the inputs as variables
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.html');
} else {
    date_default_timezone_set('Canada/Eastern');
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = new DateTime();
    $currentTime = $time->format('l, F d, Y,  g:i A  T');

// Boolean variable, used to validate form input
    $ok = true;

// Check to see if any form inputs are empty
    if (empty($title)) {
        echo 'New webpage needs a title <br />';
        $ok = false;
    }
    if (trim($content) == "") {
        echo 'New webpage needs content <br />';
        $ok = false;
    }

    if ($ok == true) {
        try {
            // Open the connection to the database
            $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

            // Turn error checking mode on
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Set up the SQL statement
            $sql = "INSERT INTO assignment2_pages (title, content, dateCreated) VALUES (:title, :content, :dateCreated)";

            // Prepare the SQL
            $cmd = $conn->prepare($sql);

            // Set up the bound parameters
            $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
            $cmd->bindParam(':content', $content, PDO::PARAM_LOB);
            $cmd->bindParam(':dateCreated', $currentTime, PDO::PARAM_STR, 50);

            // Execute the Bound Parameters
            $cmd->execute();

            //Disconnect from server
            $conn = null;

            //Redirect to admin control panel
            header('Location: control_panel.php');
        }
        //Catch exceptions
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
