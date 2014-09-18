<!DOCTYPE html>
<html lang="en">

    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Page Not Found</title>
    </head>
    <body>
        <?php
        require_once('header.php');
        echo '<div>
                <p><br /><br />Ooops! The page you are trying to load could not be found.</p>
            </div>';
        require_once('footer.php');
        ?>
    </body>

</html>
