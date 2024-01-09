<?php
    session_start();
    //Create database connection
   require_once("../inc/connect.php");
   //collect form input using post request
   if(isset($_POST["send"])){
        $user=$_POST["username"]; 
        $pass=$_POST["password"];
        //echo $user." ".$pass;
        $sql1="SELECT * FROM `login` WHERE username='$user' AND `password`='$pass'";
        $query1=mysqli_query($con, $sql1);
        $count1=mysqli_num_rows($query1);
        if($count1 >0){
            //echo "login found";
            $result1=mysqli_fetch_array($query1);
            $role=$result1["role"];
            //echo $role;
            if($role=="Admin"){
                //store username in a seesion variable
                $_SESSION["user_id"]=$user;
                $_SESSION["role"]=$role;
                 //redirect to admin dashboard
                 header("LOCATION:admin-dashboard.php");
            }else{
                //Since the position in log table are ids
                $sql2="SELECT * FROM position WHERE post_id='$role'";
                $query2=mysqli_query($con, $sql2);
                $result2=mysqli_fetch_array($query2);
                $getRole=$result2["post_name"];
                //echo $getRole;
                if($getRole=="Head of department"){
                    $_SESSION["user_id"]=$user;
                    $_SESSION["role"]=$role;
                    //redirect to admin dashboard
                    header("LOCATION:hod-dashboard.php"); 
                    //echo $count1;  
                }else if($getRole=="Dean"){
                    $_SESSION["user_id"]=$user;
                    $_SESSION["role"]=$role;
                   
                    //redirect to admin dashboard
                    header("LOCATION:dean-dashboard.php");     
                }else if($getRole=="Bursary"){
                    $_SESSION["user_id"]=$user;
                    $_SESSION["role"]=$role;
                    //redirect to admin dashboard
                    header("LOCATION:bursary-dashboard.php");     
                }else if($getRole=="Vice chancellor"){
                    $_SESSION["user_id"]=$user;
                    $_SESSION["role"]=$role;
                    //redirect to admin dashboard
                    header("LOCATION:vc-dashboard.php");      
                }else if($getRole=="Store Keeper"){
                    $_SESSION["user_id"]=$user;
                    $_SESSION["role"]=$role;
                    //redirect to admin dashboard
                    header("LOCATION:storeKeeper-dashboard.php");      
                }
            }
        }else{
            echo "<script> alert('Wrong username and password. Try again');</script>";
        }
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
                    <a href="../index.php" class="nav-item nav-link text-success">Home</a>
                    <a href="#" class="nav-item nav-link text-success">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    Login Form
                </h3>
                <form action="" method="post" style="" class="pt-4 pb-4">
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Username
                        </label>
                        <div class="col-9">
                            <input type="text" name="username" required class="form-control-sm"
                                placeholder="Enter username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Password
                        </label>
                        <div class="col-9">
                            <input type="password" name="password" required class="form-control-sm"
                                placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-9 offset-2">
                            <input type="submit" name="send" value="login" required
                                class="btn btn-success pt-1 pb-1 pl-4 pr-4" placeholder="Enter password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once("../inc/footer.php"); ?>
</body>

</html>