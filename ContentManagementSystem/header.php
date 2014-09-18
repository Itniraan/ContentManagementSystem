<header>
<img src = "images/logo.jpg" alt = "Logo"  width="20%" height="15%" />  

    <nav>
        <ul>
            <?php
            try {
                /**
                 * PHP for the dynamic navbar. It will check the database, and attribute the id and 
                 * title of each page in the database to a new link on the navbar.
                 */
                //Open connection to th database
                $conn = new PDO('mysql:host=localhost;dbname=db200260568', 'db200260568', '70707');
                // Set Error checking mode
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Set up the SQL query
                $sql = "SELECT pageID, title FROM assignment2_pages ORDER BY pageID";
                $result = $conn->query($sql);
                // Loop through the results, and add them into the navbar
                echo '<ul>';
                foreach ($result as $row) {
                    echo ' <li class="nav"><a class="nav" href="default.php?id=' . $row['pageID'] . '" 
                        alt="' . $row['title'] . '"><strong>' . $row['title'] . '</strong></a></li>';
                }
                echo '</ul>';
                // Close the connection
                $conn = null;
            }
            // Catch any errors
            catch (PDOException $pe) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 PDO error', $pe, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            } catch (exception $e) {
                mail('200260568@student.georgianc.on.ca', 'Assignment 02 error', $e, 'From: error@georgiancollege.ca');
                echo 'Sorry, there was an error trying to retrieve the page you requested. Please try again.';
            }
            ?>
        </ul>
    </nav>
</header>