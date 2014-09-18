<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>CMS Opening Page</title>
    </head>
    <body>
        <?php
            require_once('header.php');
        ?>
        <h1>Welcome to my CMS!!</h1>
        <div id="index">
            <h2>Would you like to: </h2>
            <ul>
                <li><a href="register_admin.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>
