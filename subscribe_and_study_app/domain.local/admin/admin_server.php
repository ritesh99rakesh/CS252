<?php
include("../db_conn.php");

// initializing variables
$errors = array();

// REGISTER USER
if (isset($_GET['delete_user'])) {
    // receive all input values from the form
    $user_id = mysqli_real_escape_string($db, $_GET['user_id']);


    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM user WHERE id='$user_id'";
    $result = mysqli_query($db, $query);
    $teacher = mysqli_fetch_assoc($result);


    if (!$teacher) { // if course exists
        header('location dashboard.php');
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "DELETE FROM user WHERE id='$user_id'";
        mysqli_query($db, $query);
        header('location: dashboard.php');
    }
}

