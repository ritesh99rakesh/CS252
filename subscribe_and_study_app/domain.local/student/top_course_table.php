<?php
include("../db_conn.php");

$query = "SELECT C.id, SC.prof_id, C.course_no, C.course_name FROM course C, student_course SC WHERE C.id = SC.course_id AND SC.user_id=$user_id ORDER BY SC.last_view_date DESC LIMIT 1";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $course['course_name'] . "</td><td><a href='view_course.php?course_id=" . $course['id'] . "&prof_id=" . $course['prof_id'] . "'>" . $course['course_no'] . "</a>" . "</td></tr>";
}
