<?php
if ($_SESSION['category'] != "professor") {
    include("../category_redirect.php");
}