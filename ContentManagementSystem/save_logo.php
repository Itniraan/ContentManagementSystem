<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('styles.css');
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Save Logo</title>
    </head>
    <body>
        <?php
        require_once('header.php');
        // Check if user is logged in, if they aren't, send them back to the 
        // login screen
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('location:login.html');
        } else {
            // Get the temporary name and mime type, and store them as variables
            $tmp_name = $_FILES['logo']['tmp_name'];
            $mime_type = mime_content_type($tmp_name);
            
            // Boolean variable for validation check
            $ok = true;
            
            // Check to make sure image is a jpeg, a gif, or a png
            if (($mime_type != 'image/gif') && ($mime_type != 'image/jpeg') && ($mime_type != 'image/png')) {
                echo 'Invalid image type';
                $ok = false;
            }
            // If everything is okay, save file as new logo for website
            if ($ok == true) {
                move_uploaded_file($tmp_name, "images/logo.jpg");
                echo '<br /> Logo uploaded!';
            }
        }
        require_once('footer.php');
        ?>
    </body>
</html>
