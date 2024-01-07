<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FUD Store management system</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid bg-success p-2">
        <div class="row">
            <div class="col-12">
                <div style="float:right">
                    <i class="fa fa-twitter bg-primary text-light p-2 mr-2" style="font-size:4.5vh"></i>
                    <i class="fa fa-facebook text-light p-2 mr-2" style="font-size:4.5vh; background:blue"></i>
                    <i class="fa fa-youtube bg-danger text-light p-2 mr-2" style="font-size:4.5vh"></i>
                    <i class="fa fa-envelope bg-warning text-light p-2 mr-2" style="font-size:4.5vh"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-white border border-success p-2">
                <div class="img-container">
                    <div class="left">
                        <img src="asset/logo.jpg" style="width:100px" alt="" srcset="">
                    </div>
                    <div class="right">
                        <h2>FEDERAL UNIVERSITY DUTSE</h2>
                        <h4 class="text-center"><span class="text-success">Knowledge</span>, <span
                                class="text-danger">Excelence</span> & <span class="text-warning">Service</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light mb-3">
        <div class="container">
            <a href="#" class="navbar-brand mr-3 text-success ">
                FUD store Management System
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="#" class="nav-item nav-link text-success">Home</a>
                    <a href="server/login.php" class="nav-item nav-link text-success">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <img src="asset/gate.jpeg" width="100%" height="500px" alt="" srcset="">
            </div>
        </div>
    </div>
    <?php require_once("inc/footer.php"); ?>
</body>

</html>