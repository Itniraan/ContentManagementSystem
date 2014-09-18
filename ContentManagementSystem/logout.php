<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logout</title>
    </head>
    <body>
        <?php
        // Start the session!
        session_start();
        // Unset the variables!!
        session_unset();
        // Destroy the session!!
        session_destroy();
        // Back to the login page!!
        header('Location:login.php');
        ?>
    </body>
</html>
