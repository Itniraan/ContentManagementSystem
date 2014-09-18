<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Admin Control Panel</title>
    </head>
    <body>
        <?php
        // Check if user is logged in, if not, redirect to login page
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location:login.php');
        } else {
            require_once('header.php');
            echo '<h1>Welcome to the admin control panel!</h1>';
            echo '<div id="control"><ul>
    			<li><a href="admin_table.php">List, Update, or Delete Admins</a></li>
                        <li><a href="upload_logo.php">Upload a logo</a></li>
                        <li><a href="add_new_page.php">Add a New Page to the Website</a></li>
                        <li><a href="web_page_panel.php">List, Edit or Delete Web Pages</a></li>
    		</ul></div>';
            require_once('footer.php');
        }
        ?>
    </body>
</html>