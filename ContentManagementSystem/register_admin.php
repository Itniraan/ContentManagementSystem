<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Register an Administrator</title>
    </head>
    <body>
        <?php
            require_once('header.php');
        ?>
        <h1>Add an Administrator</h1>
        <form method="post" action="admin_validation.php">
            <fieldset>
                <legend>Contact Info</legend>
                <div>
                    <label for="firstName">First Name (No # allowed):</label>
                    <input type="text" name="firstName" autofocus />
                </div>
                <div>
                    <label for="lastName">Last Name (No # allowed):</label>
                    <input type="text" name="lastName" />
                </div>
                <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" />
                </div>
                <div>
                    <label for="city">City:</label>
                    <input type="text" name="city" />
                </div>
                <div>
                    <label for="prov">Province:</label>
                    <select name="prov">
                        <?php
                        try {
                            // Make the connection to the database
                            $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                            //Throw an error if connection failed
                            if (!$conn) {
                                die('Could not connect');
                            }

                            // This is the SQL query that will be used
                            $sql = 'SELECT provinceName FROM provinces';

                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Execute the SQL query, and store it as an array in a variable
                            $result = $conn->query($sql);
                            // Cycle through the array variable, and output the results to a dropdown list
                            foreach ($result as $row) {
                                echo '<option value = "' . $row['provinceName'] . '">' . $row['provinceName'] . '</option>';
                            }
                            // Close the connection to the database
                            $conn = null;
                          
                        } 
                        // Catch Exceptions
                        catch (PDOException $pe) {
                            mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
                            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
                        } catch (exception $e) {
                            mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
                            echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="gender">Gender:</label>
                    <select name="gender">
<?php
try {
    // Make the connection to the database
    $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

    //Throw an error if connection failed
    if (!$conn) {
        die('Could not connect');
    }

    //This is the SQL query that will be used for the dropdown list
    $sql = 'SELECT * FROM gender';

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Execute the query, and store it in as an array in a variable
    $result = $conn->query($sql);
    // Go through each part of the array, and add it to the dropdown list
    foreach ($result as $row) {
        echo '<option value = "' . $row['gender'] . '">' . $row['gender'] . '</option>';
    }
    //Close the connection
    $conn = null;
}
// Catch Exceptions
catch (PDOException $pe) {
    mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
    echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
} catch (exception $e) {
    mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
    echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
}
?>
                    </select>
                </div>
                <div>
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" name="phoneNumber" />
                </div>
                <div>
                    <label for="uEmail">Email:</label>
                    <input type="email" name="uEmail" />
                </div>
                <div>
                    <label for="cEmail">Confirm Email:</label>
                    <input type="email" name="cEmail" />
                </div>
            </fieldset>
            <fieldset>
                <legend>User Login Info</legend>
                <div>
                    <label for="userName">Username:</label>
                    <input type="text" name="userName" />
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" />
                </div>
                <div>
                    <label for="cPassword">Confirm Password: </label>
                    <input type="password" name ="cPassword" />
                </div>
            </fieldset>
            <div>
                <input type="submit" name="submit" value="Submit" />
                <input type="reset" name="reset" value="Reset" />
            </div>
        </form>
<?php
require_once('footer.php');
?>
    </body>
</html>
