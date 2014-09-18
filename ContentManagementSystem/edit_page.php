<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('styles.css');
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update Page</title>
    </head>
    <body>
        <?php
        // Check if user is logged in, if not, redirect to login page
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location:login.php');
        } else {
            require_once('header.php');
            try {
                //connect to DB
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                //Turn Error mode on
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //store the selected ID from the admin table
                $id = $_GET['id'];

                //write and run the sql select and store the results
                $sql = "SELECT * FROM assignment2_pages WHERE pageID = '$id'";
                $result = $conn->query($sql);
                
                //store the information into variables
                foreach ($result as $row) {
                    $title = $row['title'];
                    $content = $row['content'];
                }
                //disconnect
                $conn = null;
            }
            // Catch exceptions
            catch (PDOException $pe) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO Error', $pe, 'From: error@georgiancollege.ca');
                echo 'Ooops! We had a problem trying to retrieve the page you requested, Please try again.';
            } catch (exception $e) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 Error', $e, 'From: error@georgiancollege.ca');
                echo 'Ooops! We had a problem trying to retrieve the page you requested, Please try again.';
            }
        }
        ?>
        <form action="update_page.php" method="post">
            <div>
                <label for="title">Title of Page: </label>
                <input type="text" name="title" value="<?php echo $title ?>" />
            </div>
            <div>
                <label for="content">Content of Page: </label>
                <textarea rows="10" cols="30" name="content">
                    <?php echo $content ?>
                </textarea>
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="submit" name="submit" value="Submit" />
                <input type="reset" name="reset" value="Reset" />
            </div>
        </form>
        <?php
            require_once('footer.php');
        ?>
    </body>
</html>
