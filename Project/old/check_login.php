<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    echo 'true';
} else {
    echo 'false';
}
?>
