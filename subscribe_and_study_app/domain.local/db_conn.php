<?php
session_start();

$user_id = $_SESSION['user_id'];

// connect to the database
$db = mysqli_connect('domain.local', 'admin', 'password', 'dummy');