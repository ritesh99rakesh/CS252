<?php
include("../db_conn.php");

$query = "SELECT C.id, C.course_no, C.course_name FROM course C, teacher_course TC WHERE C.id = TC.course_id AND TC.user_id=$user_id ORDER BY TC.start_date";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    $course_id = $course['id'];
    echo "<tr><td>" . $course['course_name'] . "</td><td><a href='create_lecture.php?id=" . $course_id . "'>" . $course['course_no'] . "</a> " . "</td><td><a href='delete_course.php?id=" . $course_id . "'>Delete Course</a></td></tr>";
}
