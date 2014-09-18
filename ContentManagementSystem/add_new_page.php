<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('styles.css');
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add a New Page</title>
    </head>
    <body>
        <?php
        require_once('header.php');
        // Check if user is logged in, if not, redirect to login page
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location:login.html');
        } else {
            // User form for adding a new page
        echo '<form action="validate_new_page.php" method="post">
            <div>
                <label for="title">Title of New Page: </label>
                <input type="text" name="title" autofocus/>
            </div>
            <div>
                <label id="content" for="content">Content of New Page: </label>
                <textarea rows="10" cols="30" name="content">
                </textarea>
            </div>
            <div>
                <input type="submit" name="submit" value="Submit" />
                <input type="reset" name="reset" value="Reset" />
            </div> 
        </form>';
        }
            require_once('footer.php');
        ?>
    </body>
</html>
