<?php

include("../db_conn.php");
$query = "SELECT * FROM user";
$result = mysqli_query($db, $query);

while ($course = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $course['username'] . "</td><td>" . $course['category'] . "</td><td><a href='delete_user.php?user_id=" . $course['id'] . "'>Delete User</a></td></tr>";
}
