<?php
    session_start();
    require_once("../inc/connect.php");
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
    $role=$_SESSION["role"];
    $sql="SELECT * FROM position WHERE post_id='$role'";
    $query=mysqli_query($con, $sql);
    $result=mysqli_fetch_array($query);
    $role=$result["post_name"];
    if(isset($_POST["send"])){
        //item_id emp_num qty request_date collection_date dept_id fact_id status
        $fact_id=$_POST["fact_id"];
        $dept_id=$_POST["dept_id"];
        $item_id  =$_POST["item_id"];
        $store_qty =$_POST["store_qty"];
        $qty=$_POST["qty"];
        $request_date=date('d-m-Y');
        if($qty > $store_qty){
            echo "<script> alert('Request for smaller quantity')</script>";      
        }else{
            $sql1="INSERT INTO request (item_id, emp_num, qty, request_date, collection_date, dept_id, fact_id, `status`) 
            VALUES('$item_id', '$user', '$qty', '$request_date','','$dept_id', $fact_id,'1')";
            $query1=mysqli_query($con, $sql1) or die(mysqli_error($con));
            if($query1){
                echo "<script> alert('Request sent successfully')</script>"; 
            }else{
                echo "<script> alert('Fail to send request')</script>";
            }
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
                    <?php
                        require_once('dynamic-nav.php');
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    All request history
                </h3>
                <table class="table table-border table-striped">
                    <thead>
                        <tr>
                            <!--	item_id	emp_num	qty	request_date	collection_date	dept_id	fact_id	status-->
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Request by</th>
                            <th>Position</th>
                            <th>Faculty</th>
                            <th>Department</th>
                            <th>Request date</th>
                            <th>Colloction date</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //0 just sent by hod, 1 approved by dean, 2 approve by vc, 3 approve by bursary, 4 approve by store
                            //5 approve by hod. Now collection date should be updated 
                            $i=1;
                            if($role=="Head of department"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON r.emp_num=s.emp_num INNER JOIN department d ON s.dept_id=d.dept_id 
                                INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                                WHERE s.emp_num='$user'";    
                            }elseif($role=="Dean"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON r.emp_num=s.emp_num INNER JOIN department d ON s.dept_id=d.dept_id 
                                INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                               ";     
                            }else if($role=="Vice chancellor" || $role=="Bursary" || $role=="Store Keeper"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON r.emp_num=s.emp_num INNER JOIN department d ON s.dept_id=d.dept_id 
                            INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                            ";
                            }
                           
                            $query2=mysqli_query($con, $sql2);
                            while($result2=mysqli_fetch_array($query2)){
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result2["item"] ;?></td>
                            <td><?php echo $result2["qty"] ;?></td>
                            <td><?php echo $result2["full_name"] ;?></td>
                            <td><?php echo $result2["post_name"] ;?></td>
                            <td><?php echo $result2["fact_name"] ;?></td>
                            <td><?php echo $result2["dept_name"] ;?></td>
                            <td><?php echo $result2["request_date"] ;?></td>
                            <td>
                                <?php 
                                    
                                    if($result2["collection_date"]==""){
                                        echo "Item not collected";  
                                    }else{
                                        echo $result2["collection_date"] ;    
                                    }
                                ?>
                            </td>
                            <?php
                                $status=$result2["request_status"];
                                if($status!=5){
                                    echo "<td class='bg-warning text-white'>New</td>";
                                }else{
                                    echo "<td class='bg-success text-white'>Approved</td>";
                                }
                            ?>
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