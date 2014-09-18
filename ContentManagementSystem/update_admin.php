<!DOCTYPE html>
<html lang="en">

    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Update Admin Record</title>
    </head>

    <body>
        <?php
        // Check if user is logged in, if not, redirect to login page
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('location:login.htm');
            exit();
        } else {
            //store the inputs
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $prov = $_POST['prov'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phoneNumber'];
            $userName = $_POST['userName'];
            $uEmail = $_POST['uEmail'];
            $cEmail = $_POST['cEmail'];
            $password = $_POST['password'];
            $id = $_POST['id'];

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
                echo 'Please enter either your current password or a new password you would like to use';
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


            if ($ok == true) {
                try {
                    $password = hash('sha512', $password);
                    //connect to DB
                    $conn = new PDO('mysql:host=webdesign4;dbname=db200260568', 'db200260568', '70707');
                    
                    // Turn on error reporting
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // The SQL that is going to be run
                    $sql = "UPDATE assignment2_admins SET 
                        firstName = :firstName, 
                        lastName = :lastName, 
                        address = :address, 
                        city = :city, 
                        prov = :prov, 
                        gender = :gender, 
                        phoneNumber = :phoneNumber, 
                        userName = :userName, 
                        password = :password, 
                        email = :email WHERE adminID = :id";

                    //Prepare the SQL
                    $cmd = $conn->prepare($sql);

                    //Add the Parameter Values
                    $cmd->bindParam(':firstName', $firstName, PDO::PARAM_STR, 30);
                    $cmd->bindParam(':lastName', $lastName, PDO::PARAM_STR, 40);
                    $cmd->bindParam(':address', $address, PDO::PARAM_STR, 150);
                    $cmd->bindParam(':city', $city, PDO::PARAM_STR, 40);
                    $cmd->bindParam(':prov', $prov, PDO::PARAM_STR, 2);
                    $cmd->bindParam(':gender', $gender, PDO::PARAM_STR, 6);
                    $cmd->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR, 10);
                    $cmd->bindParam(':userName', $userName, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':email', $uEmail, PDO::PARAM_STR, 50);
                    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 512);
                    $cmd->bindParam(':id', $id, PDO::PARAM_INT);

                    //Execute the SQL
                    $cmd->execute();

                    //disconnect
                    $conn = null;

                    //redirect to admin table
                    header('Location:admin_table.php');

                    // Catch exceptions
                } catch (PDOException $pe) {
                    mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
                    echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
                } catch (exception $e) {
                    mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
                    echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
                }
            }
        }
        ?>
    </body>

</html>
