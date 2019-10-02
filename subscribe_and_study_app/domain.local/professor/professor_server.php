<?php
include("../db_conn.php");

// initializing variables
$course_no = "";
$course_name = "";
$errors = array();

if (isset($_GET['add_course'])) {
    // receive all input values from the form
    $course_id = mysqli_real_escape_string($db, $_GET['course_id']);


    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM teacher_course WHERE course_id='$course_id' AND user_id='$user_id' LIMIT 1";
    $result = mysqli_query($db, $query);
    $teacher = mysqli_fetch_assoc($result);


    if ($teacher) { // if course exists
        header('location my_course.php');
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO teacher_course (user_id, course_id, start_date) VALUES ('$user_id', '$course_id', curdate())";
        mysqli_query($db, $query);
        header('location: my_course.php');
    }
}

if (isset($_POST['reg_course'])) {
    // receive all input values from the form
    $course_no = mysqli_real_escape_string($db, $_POST['course_no']);
    $course_name = mysqli_real_escape_string($db, $_POST['course_name']);
    $stream = mysqli_real_escape_string($db, $_POST['stream']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($course_no)) {
        array_push($errors, "Username is required");
    }
    if (empty($course_name)) {
        array_push($errors, "Email is required");
    }
    if (empty($stream)) {
        array_push($errors, "Category is required");
    }

    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM course WHERE course_no='$course_no' LIMIT 1";
    $result = mysqli_query($db, $query);
    $course = mysqli_fetch_assoc($result);

    if ($course) { // if course exists
        if ($course['course_no'] === $course_no) {
            array_push($errors, "Course already exists. Go to 'All Courses' to teach this course.");
        }
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO course (course_no, course_name, stream, enrolled) VALUES ('$course_no', '$course_name', '$stream', 0)";
        mysqli_query($db, $query);
        header('location: all_course.php');
    }
}

if (isset($_GET['pub_lecture'])) {
    // receive all input values from the form
    $topic_name = mysqli_real_escape_string($db, $_GET['topic_name']);
    $lecture = mysqli_real_escape_string($db, $_GET['lecture']);
    $course_id = mysqli_real_escape_string($db, $_GET['course_id']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($topic_name)) {
        array_push($errors, "Topic is required");
    }
    if (empty($lecture)) {
        array_push($errors, "Lecture is required");
    }

    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM course_lecture WHERE user_id='$user_id' AND course_id='$course_id' AND topic_name='$topic_name' LIMIT 1";
    $result = mysqli_query($db, $query);
    $course = mysqli_fetch_assoc($result);

    if ($course) { // if course exists
        array_push($errors, "Lecture topic already exists. Choose different lecture title.");
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO course_lecture (user_id, course_id, topic_name, lecture) VALUES ('$user_id', '$course_id', '$topic_name', '$lecture')";
        mysqli_query($db, $query);
        header('location: my_course.php');
    }
}

if (isset($_GET['delete_course'])) {
    // receive all input values from the form
    $course_id = mysqli_real_escape_string($db, $_GET['course_id']);


    // first check the database to make sure
    // a course does not already exist with the same course number
    $query = "SELECT * FROM teacher_course WHERE course_id='$course_id' AND user_id='$user_id' LIMIT 1";
    $result = mysqli_query($db, $query);
    $teacher = mysqli_fetch_assoc($result);


    if (!$teacher) { // if course exists
        header('location my_course.php');
    }

    // Finally, register course if there are no errors in the form
    if (count($errors) == 0) {
        $query = "DELETE FROM teacher_course WHERE user_id='$user_id' AND course_id='$course_id'";
        mysqli_query($db, $query);
        header('location: my_course.php');
    }
}
