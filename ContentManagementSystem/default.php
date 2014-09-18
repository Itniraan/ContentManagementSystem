<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('styles.css');
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php
            try {
                // Open a connection to the database
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                // Turn on error checking mode
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check to see if there is a page id that the user clicked on
                // If its empty, get the first page ID in the 
                if (!is_numeric($_GET['id'])) {
                    header('Location:404.php');
                }
                if (empty($_GET['id'])) {
                    $sql = "SELECT pageID FROM assignment2_pages LIMIT 1";

                    $result = $conn->query($sql);

                    // Loop through the page ID's, and use the first one
                    foreach ($result as $row) {
                        $id = $row['pageID'];
                    }
                    // Otherwise, use the page ID the user clicked on
                } else {
                    $id = $_GET['id'];
                }

                // Create the SQL query
                $sql = "SELECT title FROM assignment2_pages WHERE pageID = :id";

                // Prepare the SQL query
                $cmd = $conn->prepare($sql);

                // Bind the parameters
                $cmd->bindParam(':id', $id, PDO::PARAM_INT);

                // Execute the SQL query
                $cmd->execute();

                // Return all the results, and store them in a variable
                $result = $cmd->fetchAll();

                // Loop through the results, and print them on the title bar
                foreach ($result as $row) {
                    echo $row['title'];
                }

                // Close the connection to the database
                $conn = null;
            }
            // Catch any exceptions
            catch (PDOException $pe) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            } catch (exception $e) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            }
            ?>
        </title>
    </head>
    <body>
        <?php
        require_once('header.php');
        try {
            // Open a connection to the database
            $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

            // Turn on error checking mode
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the SQL query
            $sql = "SELECT title, content FROM assignment2_pages WHERE pageID = :id";

            //Prepare the SQL query
            $cmd = $conn->prepare($sql);

            // Bind the id number, so that only integers can be used with it
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the SQL query
            $cmd->execute();

            // Return all results of the query, and store them in a variable
            $result = $cmd->fetchAll();
            echo '<div id="content">';
            // Loop through the results, and print them to the screen
            foreach ($result as $row) {
                echo '<h1 id="content">' . $row['title'] . '</h1>';
                echo '<p>' . $row['content'] . '</p>';
            }
            echo '</div>';
            // Close the connection to the database
            $conn = null;
        }
        // Catch any exceptions
        catch (PDOException $pe) {
            mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
        } catch (exception $e) {
            mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
        }
        require_once('footer.php');
        ?>
    </body>
</html>
