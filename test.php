<?php
session_start();

if(isset($_SESSION['user_email'])) {
    echo "Session is working: " . $_SESSION['user_email'];
} else {
    echo "Session NOT working";
}
?>