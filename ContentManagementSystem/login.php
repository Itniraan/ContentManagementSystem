<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login to the CMS</title>
    </head>
    <body>
        <?php
            require_once('header.php');
        ?>
        <form method="post" action="login_validation.php">
            <div>
                <label for="userName">Username:</label>
                <input type="text" name="userName" autofocus/>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" />
            </div>
            <div>
                <input type="submit" name="submit" value="Login" />
            </div>
        </form>
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>
