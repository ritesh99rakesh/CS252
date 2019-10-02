<?php
include("../db_conn.php");

$query = "SELECT C.course_no, C.course_name FROM course C, teacher_course TC WHERE C.id = TC.course_id AND TC.user_id=$user_id ORDER BY TC.start_date LIMIT 1";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $course['course_name'] . "</td><td><a href='#'>" . $course['course_no'] . "</a> " . "</td></tr>";
}
