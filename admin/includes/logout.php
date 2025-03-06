/**
* This script handles the user logout process.
*
* It performs the following actions:
* 1. Starts the session.
* 2. Clears all session variables.
* 3. Checks if a session cookie exists and, if so, deletes it by setting its expiration time in the past.
* 4. Destroys the session.
* 5. Redirects the user to the login page.
*
*/
<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
   setcookie(session_name(), '', time() - 36000, '/');
   session_destroy();
   header("Location: ../../login.php");
}
?>