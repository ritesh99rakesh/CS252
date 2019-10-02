<?php
if ($_SESSION['category'] != "admin") {
    include("../category_redirect.php");
}