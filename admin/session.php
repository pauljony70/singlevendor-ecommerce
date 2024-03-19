<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('../app/db_connection.php');
$conn;
session_start(); // Starting Session

// Check if the user is logged in (you may have your own logic for this)
if (isset($_SESSION['admin'])) {
  // Generate and store a CSRF token in the session
  if (!isset($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32)); // Generate a random token
  }
} else {
  // Redirect to the login page if the user is not logged in
  header('Location: index.php');
  exit();
}