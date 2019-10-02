<?php
include("../db_conn.php");

// initializing variables
$errors = array();

if (isset($_GET['add_course'])) {
    // receive all input values from the form
    $course_id = mysqli_real_escape_string($db, $_GET['course_id']);
    $prof_id = mysqli_real_escape_string($db, $_GET['prof_id']);


    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM student_course WHERE course_id='$course_id' AND user_id='$user_id' AND prof_id='$prof_id' LIMIT 1";
    $result = mysqli_query($db, $query);
    $teacher = mysqli_fetch_assoc($result);


    if ($teacher) { // if course exists
        header('location my_course.php');
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO student_course (user_id, course_id, prof_id, last_view_date) VALUES ('$user_id', '$course_id', '$prof_id', curdate())";
        mysqli_query($db, $query);
        header('location: my_course.php');
    }
}

if (isset($_GET['delete_course'])) {
    // receive all input values from the form
    $course_id = mysqli_real_escape_string($db, $_GET['course_id']);
    $prof_id = mysqli_real_escape_string($db, $_GET['prof_id']);


    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM student_course WHERE course_id='$course_id' AND user_id='$user_id' AND prof_id='$prof_id' LIMIT 1";
    $result = mysqli_query($db, $query);
    $teacher = mysqli_fetch_assoc($result);


    if (!$teacher) { // if course exists
        header('location my_course.php');
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "DELETE FROM student_course WHERE user_id='$user_id' AND prof_id='$prof_id' AND course_id='$course_id'";
        mysqli_query($db, $query);
        header('location: my_course.php');
    }
}