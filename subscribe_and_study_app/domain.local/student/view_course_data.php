<?php
include("../db_conn.php");

$prof_id = $_GET['prof_id'];
$course_id = $_GET['course_id'];

$query = "SELECT topic_name, lecture FROM course_lecture WHERE course_id='$course_id' AND user_id='$prof_id'";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo '<div class="row"><div class="col-md-12"><div class="card"><div class="card-body"><h3 class="card-title">'.$course['topic_name'].'</h3><p class="card-text">'.$course['lecture'].'</p></div></div></div></div>';
}
