<?php
include('../login_auth.php');
include('professor_auth.php');
include('professor_server.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Professor</div>
        <div class="list-group list-group-flush">
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="my_course.php" class="list-group-item list-group-item-action bg-light">My Courses</a>
            <a href="all_course.php" class="list-group-item list-group-item-action bg-light">All Courses</a>
            <a href="create_course.php" class="list-group-item list-group-item-action bg-light">Create Courses</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Menu</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="dashboard.php"><?php echo $_SESSION['username'] ?></a>
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h3 class="display-3">Register Course</h3>
                    <hr class="my-2">
                    <form method="post" action="create_course.php">
                        <?php include('../errors.php'); ?>
                        <div class="form-group">
                            <label class="col-sm-1-12 col-form-label" for="course_no">Course Number</label>
                            <input type="text" class="form-control" name="course_no" id="course_no"
                                   value="<?php echo $course_no; ?>"
                                   aria-describedby="helpId" maxlength="10" placeholder="Course Number">
                            <small id="helpId" class="form-text text-muted">Enter course number here.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1-12 col-form-label" for="course_name">Course Name</label>
                            <input type="text" class="form-control" name="course_name" id="course_name"
                                   value="<?php echo $course_name; ?>"
                                   aria-describedby="helpId" maxlength="50" placeholder="Course Name">
                            <small id="helpId" class="form-text text-muted">Enter course name here.</small>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1-12 col-form-label" for="stream">Stream</label>
                            <select multiple class="form-control" name="stream" id="stream">
                                <option>SCIENCES</option>
                                <option>ENGINEERING</option>
                                <option>ECONOMICS</option>
                                <option>ARTS</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="reg_course">Register Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

<!-- /#wrapper -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</body>

</html>
