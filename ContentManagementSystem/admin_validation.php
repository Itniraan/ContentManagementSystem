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
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('location:login.html');
        } else {
            //Store the inputs as variables
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $prov = $_POST['prov'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phoneNumber'];
            $uEmail = $_POST['uEmail'];
            $cEmail = $_POST['cEmail'];
            $userName = $_POST['userName'];
            $password = hash('sha512', $_POST['password']);
            $cPassword = hash('sha512', $_POST['cPassword']);

            // Boolean flag to validate inputs
            $ok = true;

            // Check to make sure each field is filled
            if (empty($firstName)) {
                echo 'First name is required. <br />';
                $ok = false;
            }
            if (empty($lastName)) {
                echo 'Last name is required. <br />';
                $ok = false;
            }
            if (empty($address)) {
                echo 'Address is required <br />';
                $ok = false;
            }
            if (empty($city)) {
                echo 'City is required <br />';
                $ok = false;
            }
            if (empty($prov)) {
                echo 'Province is required <br/>';
                $ok = false;
            }
            if (empty($gender)) {
                echo 'Gender is required <br />';
                $ok = false;
            }
            if (empty($phoneNumber)) {
                echo 'Phone number is required <br />';
                $ok = false;
            }
            if (empty($uEmail)) {
                echo 'Email address is required <br />';
                $ok = false;
            }
            if (empty($cEmail)) {
                echo 'Confirmation email address is required <br/>';
                $ok = false;
            }
            if (empty($userName)) {
                echo 'Username is required <br />';
                $ok = false;
            }
            if (empty($password)) {
                echo 'Password is required <br/>';
                $ok = false;
            }
            if (empty($cPassword)) {
                echo 'Confirmation password is required <br />';
                $ok = false;
            }

            //Check to make sure first and last name are non-numeric
            if (is_numeric($firstName)) {
                echo 'No numbers are allowed as a first name. <br />';
                $ok = false;
            }
            if (is_numeric($lastName)) {
                echo 'No numbers are allowed as a last name. <br />';
                $ok = false;
            }

            // Check to make sure telephone numbers are numeric
            if (!is_numeric($phoneNumber) && !empty($phoneNumber)) {
                echo 'Telephone number must be numeric. <br />';
                $ok = false;
            }

            // Verification emails must match
            if ($uEmail != $cEmail) {
                echo 'Verification email fields must match <br />';
                $ok = false;
            }

            // Verification passwords must match
            if ($password != $cPassword) {
                echo 'Password and Confirm Password fields must match <br />';
                $ok = false;
            }

            // Phone number must be 10 digits, no more, no less
            if (strlen($phoneNumber) != 10 && !empty($phoneNumber)) {
                echo'Phone number must be a 10 digit numeric value. <br />';
                $ok = false;
            }

            // Validate email is in correct format
            if (!filter_var($uEmail, FILTER_VALIDATE_EMAIL)) {
                echo 'Email address is not a valid email address <br />';
                $ok = false;
            }
            if (!filter_var($cEmail, FILTER_VALIDATE_EMAIL)) {
                echo 'Confirmation email address is not a valid email address <br />';
                $ok = false;
            }

            // Connect to the db to check if email address is already in use
            try {
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                // Turn on error reporting
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Throw an error if connection failed
                if (!$conn) {
                    die('Could not connect');
                }
                // The SQL that will be used
                $sql = 'SELECT email FROM assignment2_admins';


                $result = $conn->query($sql);

                // Check if email is already in the admin table
                foreach ($result AS $row) {
                    if ($row['email'] == $uEmail) {
                        echo 'That email is already in use <br/>';
                        $ok = false;
                        break;
                    }
                }
                // Disconnect from server
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

            // Connect to the db to check if username is already in use
            try {
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                // Turn error reporting on
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Throw an error if connection failed
                if (!$conn) {
                    die('Could not connect');
                }

                //The SQL that will be used
                $sql = 'SELECT userName FROM assignment2_admins';


                $result = $conn->query($sql);

                // Check if the username is already in use
                foreach ($result AS $row) {
                    if ($row['userName'] == $userName) {
                        echo 'That username is already in use <br/>';
                        $ok = false;
                        break;
                    }
                }
                // Disconnect from server
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

            if ($ok == true) {
                try {
                    // Connect to the erver
                    $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                    // Turn on error reporting
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    //Throw an error if connection failed
                    if (!$conn) {
                        die('Could not connect');
                    }

                    //The SQL that will be used
                    $sql = 'INSERT INTO assignment2_admins (firstName, lastName, address, city, prov, gender, phoneNumber, email, userName, password) VALUES (:firstName, :lastName, :address, :city, :prov, :gender, :phoneNumber, :email, :userName, :password);';

                    // Prepare the SQL
                    $cmd = $conn->prepare($sql);

                    // Bind the parameters
                    $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 30);
                    $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 40);
                    $cmd->bindParam(':address', $address, PDO::PARAM_STR, 150);
                    $cmd->bindParam(':city', $city, PDO::PARAM_STR, 40);
                    $cmd->bindParam(':prov', $prov, PDO::PARAM_STR, 2);
                    $cmd->bindParam(':gender', $gender, PDO::PARAM_STR, 6);
                    $cmd->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR, 10);
                    $cmd->bindParam(':email', $uEmail, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':userName', $userName, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 512);

                    // Execute the SQL
                    $cmd->execute();

                    // Disconnect from the server
                    $conn = null;

                    // Mail verification email to user
                    mail($uEmail, 'Verification email: Admin Added!', 'This message is to verify that you have been registered as an admin. Your username is: ' . $userName, 'From: Blake_Murdock(200260568@student.georgianc.on.ca)');

                    echo 'Admin added! A confirmation email has been sent to your inbox.';
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
        require_once('footer.php');
        ?>
    </body>
</html>
