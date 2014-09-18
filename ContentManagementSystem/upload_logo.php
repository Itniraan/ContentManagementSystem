<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Upload Logo</title>
    </head>
    <body>
        <?php
        require_once('header.php');
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('location:login.html');
        } else {

            echo '<form action="save_logo.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="logo">Choose a logo to upload (JPG, GIF, and PNG only): </label>
                <input type="file" name="logo" />
            </div>
            <div>
                <input type="submit" name="upload" value="Upload" />
            </div>
        </form> ';
        }
        require_once('footer.php');
        ?>
    </body>
</html>
