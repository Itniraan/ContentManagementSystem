<!DOCTYPE html>
<html lang="en">

    <head>
        <style>
            @import url("styles.css");
        </style>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <title>Admin Table</title>
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
                $sql = "SELECT * FROM assignment2_admins";

                //Now add the order by clause if there is one
                if (empty($_GET['sort'])) {
                    $order_by = 'firstName'; // First search, so we have nothing to order by yet. Use title as default
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
                    <th><a href="admin_table.php?sort=firstName&direction=' . $next_direction . '">First Name</a></th>
                    <th><a href="admin_table.php?sort=lastName&direction=' . $next_direction . '">Last Name</a></th>
                    <th><a href="admin_table.php?sort=address&direction=' . $next_direction . '">Address</a></th>
                    <th><a href="admin_table.php?sort=city&direction=' . $next_direction . '">City</a></th>
                    <th><a href="admin_table.php?sort=prov&direction=' . $next_direction . '">Province</a></th>
                    <th><a href="admin_table.php?sort=gender&direction=' . $next_direction . '">Gender</a></th>
                    <th><a href="admin_table.php?sort=phoneNumber&direction=' . $next_direction . '">Phone Number</a></th>
                    <th><a href="admin_table.php?sort=email&direction=' . $next_direction . '">Email</a></th>
                    <th><a href="admin_table.php?sort=userName&direction=' . $next_direction . '">Username</a></th>
                    <th>Update</th><th>Delete</th></tr>';

                //loop through the data and create a new row with 2 columns for each record
                foreach ($result as $row) {
                    echo '<tr><td>' . $row['firstName'] . '</td>
						<td>' . $row['lastName'] . '</td>
						<td>' . $row['address'] . '</td>
						<td>' . $row['city'] . '</td>
						<td>' . $row['prov'] . '</td>
						<td>' . $row['gender'] . '</td>
						<td>' . $row['phoneNumber'] . '</td>
						<td><a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></td>
						<td>' . $row['userName'] . '</td>
						<td><a href="edit_admin.php?id=' . $row['adminID'] . '">Update</a></td>
						<td><a href="delete_admin.php?id=' . $row['adminID'] . '"
						onclick="return confirm(\'Are you sure you want to delete ' . $row['firstName'] . '?\');">Delete</a></td></tr>';
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
