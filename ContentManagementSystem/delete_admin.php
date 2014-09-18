<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete Admin</title>
    </head>
    <body>
        <?php
        // Check if user is logged in, if not, redirect to login page
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location:login.php');
        } else {
            try {
                // Connect to the database
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');
                
                // Turn on error reporting
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $id = $_GET['id'];
                
                //The SQL that will be used
                $sql = "DELETE FROM assignment2_admins WHERE adminID = :id";
                
                // Prepare the SQL
                $cmd = $conn->prepare($sql);
                
                // Bind the parameters
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);
                
                // Execute the SQL
                $cmd->execute();

                // Disconnect
                $conn = null;

                // Redirect to admin table
                header('Location: admin_table.php');
            } 
            // Catch the exceptions
            catch (PDOException $pe) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            } catch (exception $e) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            }
        }
        ?>
    </body>
</html>
