<?php
    session_start();
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
    require_once("../inc/connect.php");
    if(isset($_POST["send"])){
        $full_name=$_POST["full_name"];
        $gender=$_POST["gender"];	
        $pnum=$_POST["pnum"];	
        $email=$_POST["email"];	
        $emp_num=$_POST["emp_num"];	
        $post_id=$_POST["post_id"];	
        $fact_id=$_POST["fact_id"];	
        $dept_id=$_POST["dept_id"];	
        $sql="SELECT * FROM staff WHERE emp_num='$emp_num'";
        $query=mysqli_query($con, $sql);
        $count=mysqli_num_rows($query);
        //staff_id	full_name	gender	pnum	email	emp_num	post_id	fact_id	dept_id	status
        if($count < 1){
                $sql1="INSERT INTO staff (full_name,gender,	pnum,email,	emp_num,post_id,fact_id,dept_id,`status`) 
                VALUES('$full_name', '$gender', '$pnum',  '$email',  '$emp_num',  '$post_id',  '$fact_id', '$dept_id','1')";
                $query1=mysqli_query($con, $sql1) or die(mysqli_error($con));
                if($query1){
                    $sql4="INSERT INTO `login` (username, `password`, `role`, `log_status`) VALUES('$emp_num', '$emp_num', '$post_id', '1')";
                    $query4=mysqli_query($con, $sql4);
                    echo "<script> alert('Record added successfully')</script>"; 
                }else{
                    echo "<script> alert('fail to add record')</script>";
                }
            }else{
                    echo "<script> alert('Employment number {$emp_num} already exist in the database')</script>";
            }
    }
    if(isset($_GET["delete"])){
        $id=$_GET["delete"];
        //echo $delete; 
        $sql="DELETE FROM staff WHERE staff_id='$id'";
        $query=mysqli_query($con, $sql);
        if($query){
            echo "<script> 
                alert('Record deleted successfully');
                document.location.href='add-staff.php';
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
                    Add Staff Form
                </h3>
                <form action="" method="post" style="" class="pt-4 pb-4">
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Full name
                        </label>
                        <div class="col-9">
                            <input type="text" name="full_name" required class="form-control"
                                placeholder="Enter full name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            gender
                        </label>
                        <div class="col-9">
                            <select name="gender" id="" class="custom-select">
                                <option value="0">[--Select gender--]</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Phone number
                        </label>
                        <div class="col-9">
                            <input type="text" name="pnum" required class="form-control"
                                placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Email address
                        </label>
                        <div class="col-9">
                            <input type="email" name="email" required class="form-control"
                                placeholder="Enter email address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Employment number
                        </label>
                        <div class="col-9">
                            <input type="text" name="emp_num" required class="form-control"
                                placeholder="Enter employment number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Position name
                        </label>
                        <div class="col-9">
                            <select name="post_id" id="" class="custom-select">
                                <option value="0">[--Select position--]</option>
                                <?php
                                    $sql3="SELECT * FROM position";
                                    $query3=mysqli_query($con, $sql3);
                                    while($row3=mysqli_fetch_array($query3)){
                                ?>
                                <option value="<?php echo $row3['post_id']; ?>">
                                    <?php echo $row3['post_name']; ?>
                                </option>
                                <?php } ?>
                            </select>
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
                                    while($row3=mysqli_fetch_array($query3)){
                                ?>
                                <option value="<?php echo $row3['fact_id']; ?>">
                                    <?php echo $row3['fact_name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-3 col-form-label">
                            Department name
                        </label>
                        <div class="col-9">
                            <select name="dept_id" id="" class="custom-select">
                                <option value="0">[--Select department--]</option>
                                <?php
                                    $sql3="SELECT * FROM department";
                                    $query3=mysqli_query($con, $sql3);
                                    while($row3=mysqli_fetch_array($query3)){
                                ?>
                                <option value="<?php echo $row3['dept_id']; ?>">
                                    <?php echo $row3['dept_name']; ?>
                                </option>
                                <?php } ?>
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
                <!--	staff_id	full_name	gender	pnum	email	emp_num	post_id	fact_id	dept_id	status-->
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-border table-striped">
                    <thead>
                        <tr>
                            <!--	staff_id	full_name	gender	pnum	email	emp_num	post_id	fact_id	dept_id	status-->
                            <th>#</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone number</th>
                            <th>Email</th>
                            <th>Employment number</th>
                            <th>Position name</th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <th colspan="1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $i=1;
                            
                            $sql2="SELECT * FROM staff s INNER JOIN position p ON s.post_id=p.post_id
                            INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN department d ON d.dept_id=s.dept_id";
                            $query2=mysqli_query($con, $sql2);
                            while($result2=mysqli_fetch_array($query2)){//
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result2["full_name"] ;?></td>
                            <td><?php echo $result2["gender"] ;?></td>
                            <td><?php echo $result2["pnum"] ;?></td>
                            <td><?php echo $result2["email"] ;?></td>
                            <td><?php echo $result2["emp_num"] ;?></td>
                            <td><?php echo $result2["post_name"] ;?></td>
                            <td><?php echo $result2["fact_name"] ;?></td>
                            <td><?php echo $result2["dept_name"] ;?></td>
                            <td>
                            <td>
                                <a href="add-position.php?delete=<?php echo $result2["staff_id"]?>"
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