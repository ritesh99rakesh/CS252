<?php
include("../db_conn.php");

$query = "SELECT C.id, C.course_no, C.course_name FROM course C";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $course['course_name'] . "</td><td>" . $course['course_no'] . "</td><td><a href='add_course.php?id=" . $course['id'] . "'>Teach Course</a></td></tr>";
}
