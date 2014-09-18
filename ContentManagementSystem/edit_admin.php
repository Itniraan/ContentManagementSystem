<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update Admin</title>
    </head>
    <body>
        <?php
        // Check if user is logged in, if not, redirect to login page
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location:login.php');
        } else {
            require_once('header.php');
            try {
                //connect to DB
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                //Turn Error mode on
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //store the selected ID from the admin table
                $id = $_GET['id'];

                //write and run the sql select and store the results
                $sql = "SELECT * FROM assignment2_admins WHERE adminID = '$id'";
                $result = $conn->query($sql);

                //store the information into variables
                foreach ($result as $row) {
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $address = $row['address'];
                    $city = $row['city'];
                    $prov = $row['prov'];
                    $gender = $row['gender'];
                    $phoneNumber = $row['phoneNumber'];
                    $email = $row['email'];
                    $userName = $row['userName'];
                }

                //disconnect
                $conn = null;
            }
            // Catch exceptions
            catch (PDOException $pe) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO Error', $pe, 'From: error@georgiancollege.ca');
                echo 'Ooops! We had a problem trying to retrieve the page you requested, Please try again.';
            } catch (exception $e) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 Error', $e, 'From: error@georgiancollege.ca');
                echo 'Ooops! We had a problem trying to retrieve the page you requested, Please try again.';
            }
        }
        ?>
        <form method="post" action="update_admin.php">
            <fieldset>
                <legend>Contact Info</legend>
                <div>
                    <label for="firstName">First Name (No # allowed):</label>
                    <input name="firstName" value="<?php echo $firstName; ?>" autofocus />
                </div>
                <div>
                    <label for="lastName">Last Name (No # allowed):</label>
                    <input type="text" name="lastName" value="<?php echo $lastName; ?>" />
                </div>
                <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $address; ?>" />
                </div>
                <div>
                    <label for="city">City:</label>
                    <input type="text" name="city" value="<?php echo $city; ?>" />
                </div>
                <div>
                    <label for="prov">Province:</label>
                    <select name="prov">
                        <?php
                        try {
                            // Make the connection to the database
                            $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                            // Turn error mode on
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                            //Throw an error if connection failed
                            if (!$conn) {
                                die('Could not connect');
                            }

                            // This is the SQL query that will be used
                            $sql = 'SELECT provinceName FROM provinces';



                            // Execute the SQL query, and store it as an array in a variable
                            $result = $conn->query($sql);
                            // Cycle through the array variable, and output the results to a dropdown list
                            foreach ($result as $row) {
                                // Have the initial value be the previously selected value, instead of the first one in the list
                                if ($row['provinceName'] == $prov) {
                                    echo '<option selected value = "' . $row['provinceName'] . '">' . $row['provinceName'] . '</option>';
                                } else {
                                    echo '<option value = "' . $row['provinceName'] . '">' . $row['provinceName'] . '</option>';
                                }
                            }
                            // Close the connection to the database
                            $conn = null;
                        }
                        // Catch exceptions
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
                    <select name="gender" selected="<?php echo $gender; ?>">
                        <?php
                        try {
                            // Make the connection to the database
                            $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');
                            
                            // Turn on error reporting
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            //Throw an error if connection failed
                            if (!$conn) {
                                die('Could not connect');
                            }

                            //This is the SQL query that will be used for the dropdown list
                            $sql = 'SELECT * FROM gender';

                            

                            //Execute the query, and store it in as an array in a variable
                            $result = $conn->query($sql);
                            // Go through each part of the array, and add it to the dropdown list
                            foreach ($result as $row) {
                                // Have the initial value be the previously selected value, instead of the first one in the list
                                if ($row['gender'] == $gender) {
                                    echo '<option selected value = "' . $row['gender'] . '">' . $row['gender'] . '</option>';
                                } else {
                                    echo '<option value = "' . $row['gender'] . '">' . $row['gender'] . '</option>';
                                }
                            }
                            //Close the connection
                            $conn = null;
                        } 
                        // Catch exceptions
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
                    <input type="tel" name="phoneNumber" value="<?php echo $phoneNumber; ?>" />
                </div>
                <div>
                    <label for="uEmail">Email:</label>
                    <input type="email" name="uEmail" value="<?php echo $email; ?>" />
                </div>
                <div>
                    <label for="cEmail">Confirm Email:</label>
                    <input type="email" name="cEmail" value="<?php echo $email; ?>" />
                </div>
            </fieldset>
            <fieldset>
                <legend>User Login Info</legend>
                <div>
                    <label for="userName">Username:</label>
                    <input type="text" name="userName" value="<?php echo $userName; ?>" />
                </div>
                <div>
                    <label for="password">Password: </label>
                    <input type="password" name="password" />
                </div>
            </fieldset>
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" name="submit" value="Submit" />
                <input type="reset" name="reset" value="Reset" />
            </div>
        </form>
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>
