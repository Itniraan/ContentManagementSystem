<!DOCTYPE html>
<html>
    <head>
        <style>
            @import url('styles.css');
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Webpage Table</title>
    </head>
    <body>
        <?php
        require_once('header.php');
        // Check if user is logged in, if not, redirect to login page
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('location:login.html');
        } else {
            try {
                //connect to db
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');

                // Turn on error reporting
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //set up query
                $sql = "SELECT * FROM assignment2_pages";
                //Now add the order by clause if there is one
                if (empty($_GET['sort'])) {
                    $order_by = 'title'; // First search, so we have nothing to order by yet. Use title as default
                } else {
                    $order_by = $_GET['sort']; // User clicked a column, so sort by that column
                }

                $order = " ORDER BY $order_by";
                $sql .= $order;

                // Now track the sort direction
                if (empty($_GET['direction'])) {
                    $direction = "ASC"; // First search, have no direction yet, use A - Z as default
                } else {
                    $direction = $_GET['direction']; // User selected a direction
                }

                //Set our direction to go the opposite way if the user clicks again and reload the page
                if ($direction == 'ASC') {
                    $next_direction = 'DESC'; // A-Z now, so next sort will be Z-A
                } else {
                    $next_direction = 'ASC'; // Z-A now, so next sort will be A-Z
                }

                // Append the direction to the sql query
                $sql .= " $direction";
                //run the query and store the results
                $result = $conn->query($sql);
                //start our table
                echo '<table border="1"><tr>
                    <th><a href="web_page_panel.php?sort=title&direction=' . $next_direction . '">Page Name</a></th>
                        <th><a href="web_page_panel.php?sort=dateCreated&direction=' . $next_direction . '">Date Created</a></th>
                        <th>Update</th>
                        <th>Delete</th></tr>';

                //loop through the data and create a new row with 2 columns for each record
                foreach ($result as $row) {
                    echo '<tr><td>' . $row['title'] . '</td>
                  <td>' . $row['dateCreated'] . '</td>
                  <td><a href="edit_page.php?id=' . $row['pageID'] . '">Update</a></td>
                  <td><a href="delete_page.php?id=' . $row['pageID'] . '"
                  onclick="return confirm(\'Are you sure you want to delete ' . $row['title'] . '?\');">Delete</a></td></tr>';
                }

                //close the table
                echo '</table>';

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
        require_once('footer.php');
        ?>
    </body>
</html>
