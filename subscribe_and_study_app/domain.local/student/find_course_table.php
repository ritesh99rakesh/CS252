<?php
include("../db_conn.php");

$query = "SELECT C.id AS course_id, U.id AS prof_id, C.course_no, C.course_name, C.stream, U.username FROM course C, user U, teacher_course TC WHERE TC.course_id = C.id AND TC.user_id = U.id AND U.category = 'professor' ORDER BY C.enrolled DESC";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $course['course_no'] . "</td><td>" . $course['course_name'] . "</td><td>" . strtoupper($course['stream']) . "</td><td>" . $course['username'] . "</td><td><a href='add_course.php?course_id=" . $course['course_id'] . "&prof_id=" . $course['prof_id'] . "'>Register</a></td></tr>";
}
