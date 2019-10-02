<?php
if ($_SESSION['category'] != "student") {
    include("../category_redirect.php");
}