<?php
    session_start();
    require_once("../inc/connect.php");
    $user=$_SESSION["user_id"];
    $role=$_SESSION["role"];
    $sql="SELECT * FROM position WHERE post_id='$role'";
    $query=mysqli_query($con, $sql);
    $result=mysqli_fetch_array($query);
    $role=$result["post_name"];
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
    <?php require_once("../inc/header.php"); ?>
    <?php //require_once("../inc/admin-nav.php"); ?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="text-center p-2 bg-success" style="">
                    <?php
                    echo "$role Dashboard";
                    ?>
                </h3>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                <a href="approve-item.php">Approve Request</a>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                <a href="new-request.php">Monitor Request</a>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                <a href="request-history.php">Request History</a>
            </div>
            <div class="col-4 border shadow text-center m-2" style="height:200px; padding:100px">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <?php include_once("../inc/footer.php"); ?>
</body>

</html>