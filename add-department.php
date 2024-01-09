<?php
    session_start();
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
    require_once("../inc/connect.php");
    if(isset($_POST["send"])){
        $fact_id=$_POST["fact_id"];
        $dept_name=$_POST["dept_name"];
       $sql="SELECT * FROM department WHERE dept_name='$dept_name'";
       $query=mysqli_query($con, $sql);
       $count=mysqli_num_rows($query);
       if($count < 1){//dept_id	dept_name	fact_id	dept_status
        $sql1="INSERT INTO department (dept_name, fact_id, dept_status) VALUES('$dept_name', $fact_id,'1')";
            $query1=mysqli_query($con, $sql1) or die(mysqli_error($con));
            if($query1){
                echo "<script> alert('Record added successfully')</script>"; 
            }else{
                echo "<script> alert('fail to add record')</script>";
            }
        }else{
                echo "<script> alert('{$dept_name} already exist in the database')</script>";
        }
    }
    if(isset($_GET["delete"])){
        $id=$_GET["delete"];
        //echo $delete; 
        $sql="DELETE FROM department WHERE dept_id='$id'";
        $query=mysqli_query($con, $sql);
        if($query){
            echo "<script> 
                alert('Record deleted successfully');
                document.location.href='add-department.php';
                </script>";
        }else{
            echo "<script> alert('Fail to delete record')</script>";
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
                    <a href="admin-dashboard.php" class="nav-item nav-link text-success">Previous</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    Add Department Form
                </h3>
                <form action="" method="post" style="" class="pt-4 pb-4">
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Department name
                        </label>
                        <div class="col-9">
                            <input type="text" name="dept_name" required class="form-control-sm"
                                placeholder="Enter department name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Faculty name
                        </label>
                        <div class="col-9">
                            <select name="fact_id" id="" class="custom-select">
                                <option value="0">[--Select faculty--]</option>
                                <?php
                                    $sql3="SELECT * FROM faculty";
                                    $query3=mysqli_query($con, $sql3);
                                    while($result3=mysqli_fetch_array($query3)){
                                ?>
                                <option value="<?php echo $result3['fact_id']; ?>">
                                    <?php echo $result3['fact_name']; ?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-9 offset-2">
                            <input type="submit" name="send" value="Add" required
                                class="btn btn-success pt-1 pb-1 pl-4 pr-4" placeholder="Enter password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-border table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department name</th>
                            <th>Faculty name</th>
                            <th colspan="1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            $sql2="SELECT * FROM department d INNER JOIN faculty f ON d.fact_id=f.fact_id";
                            $query2=mysqli_query($con, $sql2);
                            while($result2=mysqli_fetch_array($query2)){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result2["dept_name"] ;?></td>
                            <td><?php echo $result2["fact_name"] ;?></td>
                            <td>
                                <a href="add-department.php?delete=<?php echo $result2["dept_id"]?>"
                                    onclick="confirm('Do you want to delete this record?')">
                                    <i class="fa fa-trash text-danger"></i>
                                </a>
                            </td>
                            <!--<td></td> -->
                        </tr>
                        <?php $i++;} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include_once("../inc/footer.php"); ?>
</body>

</html>