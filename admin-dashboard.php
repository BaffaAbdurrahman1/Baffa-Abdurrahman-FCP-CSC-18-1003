<?php
    session_start();
    require_once("../inc/connect.php");
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php require_once('../inc/title.php'); ?></title>
    <?php require_once("../inc/links.php"); ?>
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
    <?php require_once("../inc/header.php"); ?>
    <?php require_once("../inc/admin-nav.php"); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="text-center p-2 bg-success" style="">
                    Store Statistics
                </h3>
            </div>

            <?php
                $sql1="SELECT * FROM staff";
                $query1=mysqli_query($con, $sql1);
                $count1=mysqli_num_rows($query1);

                $sql2="SELECT * FROM faculty";
                $query2=mysqli_query($con, $sql2);
                $count2=mysqli_num_rows($query2);

                $sql3="SELECT * FROM department";
                $query3=mysqli_query($con, $sql3);
                $count3=mysqli_num_rows($query3);

                $sql4="SELECT * FROM request";
                $query4=mysqli_query($con, $sql4);
                $count4=mysqli_num_rows($query4);
            ?>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                Number of Staff: <?php echo $count1; ?>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                Number of Faculty: <?php echo $count2; ?>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                Number of Department: <?php echo $count3; ?>
            </div>

            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                Number of request: <?php echo $count4; ?>
            </div>
        </div>
    </div>
    <?php include_once("../inc/footer.php"); ?>
</body>

</html>