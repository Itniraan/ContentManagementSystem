<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Validate Login Info</title>
    </head>
    <body>
        <?php
        //store the user inputs in variables and hash the password
        $userName = $_POST['userName'];
        $password = hash('sha512', $_POST['password']);

        $ok = true;

        if (empty($userName)) {
            echo 'Please enter a username, and try again <br />';
            $ok = false;
        }
        if (empty($password)) {
            echo 'Please enter a password, and try again <br />';
            $ok = false;
        }
        if ($ok == true) {
            try {
                //connect to db
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');
                
                // Turn on Error reporting
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //set up and run the query
                $sql = "SELECT adminID FROM assignment2_admins WHERE userName = '$userName' AND password = '$password'";
                $result = $conn->query($sql);

                //store the number of results in a variable
                $count = $result->rowCount();

                //check if any matches found
                if ($count == 1) {
                    echo 'Logged in Successfully.';

                    //if we found matches, we need to determine and store the user's id
                    foreach ($result as $row) {

                        //access the existing session created automatically by the server
                        session_start();

                        //take the user's id from the database and store it in a session variable
                        $_SESSION['user_id'] = $row['adminID'];

                        //redirect the user
                        header('Location: control_panel.php');
                    }
                } else {
                    echo 'Invalid Login';
                    // Redirect to login page
                    header('Location: login.php');
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
        }
        ?>
    </body>
</html>
