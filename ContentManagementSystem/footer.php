<footer>
    <?php
    // Check to see if admin is logged in
    // If they are, display a link to the control panel and a link to logout
    session_start();
    if (isset($_SESSION['user_id'])) {
        echo '<form method="post" action="control_panel.php">
        <input type="submit" name="admin" value="Go to Admin Control Panel" />
    </form>';
        echo '<form method="post" action="logout.php">
        <input type="submit" name="logout" value="Logout" />
    </form>';
        // If they are not logged in, show a button that allows them to login
    } else {
        echo '<form method="post" action="login.php">
        <input type="submit" name="login" value="Login to Admin" />
    </form>';
    }
    echo '<small>Copyright: <a href="mailto:200260568@student.georgianc.on.ca">Blake Murdock</a>, 2014</small>';
    ?>
</footer>