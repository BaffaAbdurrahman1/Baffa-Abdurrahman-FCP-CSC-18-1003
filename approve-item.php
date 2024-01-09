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
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $editable=$_GET["editable"];
        echo $id." ".$editable;
        if($editable==0){
            $sql="UPDATE request SET request_status='1' WHERE request_id='$id'";
            //$query=mysqli_query($con, $sql); 
            //Dean update it to 1  
        }else if($editable==1){
            $sql="UPDATE request SET request_status='2' WHERE request_id='$id'";
            //$query=mysqli_query($con, $sql);  
            //Vice chancellor Update it to 2
        }else if($editable==2){
            $sql="UPDATE request SET request_status='3' WHERE request_id='$id'";
            //$query=mysqli_query($con, $sql); 
            //Bursary update it to 3  
        }else if($editable==3){
            $sql="UPDATE request SET request_status='4' WHERE request_id='$id'";
            //$query=mysqli_query($con, $sql);   
        }
        $query=mysqli_query($con, $sql); 
        if($query){
            echo "<script> 
                alert('Item approve successfully');
                document.location.href='approve-item.php';
                </script>";
        }else{
            echo "<script> alert('Fail to approve item')</script>";
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
                    <?php  require_once('dynamic-nav.php'); ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    Approve Request
                </h3>
                <table class="table table-border table-striped">
                    <thead>
                        <tr>
                            <!--	item_id	emp_num	qty	request_date	collection_date	dept_id	fact_id	status-->
                            <th>#</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Request by</th>
                            <th>Request date</th>
                            <th>Colloction date</th>
                            <th>Approval status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //0 just sent by hod, 1 approved by dean, 2 approve by vc, 3 approve by bursary, 4 approve by store
                            //5 approve by hod. Now collection date should be updated 
                            $i=1;
                            if($role=="Dean"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON s.emp_num=r.emp_num INNER JOIN department d ON r.dept_id=d.dept_id 
                                INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                                WHERE request_status='0'";   
                            }else if($role=="Vice chancellor"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON s.emp_num=r.emp_num INNER JOIN department d ON r.dept_id=d.dept_id 
                            INNER JOIN faculty f ON f.fact_id=r.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                            WHERE request_status='1'";  
                            }else if($role=="Bursary"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON s.emp_num=r.emp_num INNER JOIN department d ON r.dept_id=d.dept_id 
                                INNER JOIN faculty f ON f.fact_id=r.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                                WHERE request_status='2'"; 
                            }else if($role=="Store Keeper"){
                                $sql2="SELECT * FROM request r INNER JOIN staff s ON s.emp_num=r.emp_num INNER JOIN department d ON r.dept_id=d.dept_id 
                                INNER JOIN faculty f ON f.fact_id=r.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                                WHERE request_status='3'";
                            }
                           
                            $query2=mysqli_query($con, $sql2);
                            $count2=mysqli_num_rows($query2);
                            if($count2 > 0){
                            while($result2=mysqli_fetch_array($query2)){
                                $status=$result2["request_status"];
                            
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result2["item"] ;?></td>
                            <td><?php echo $result2["qty"] ;?></td>
                            <td><?php echo $result2["full_name"] ;?></td>

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
                                if($status!=5) {
                                    echo "<td class='bg-warning text-white'>Processing</td>";
                                }else{
                                    echo "<td class='bg-success text-white'>Approved</td>";  
                                }
                            ?>

                            <td>
                                <?php
                                    if($status==0) {
                                        echo "<a href='approve-item.php?id={$result2['request_id']}&&editable=0' onclick='confirm('Do you want to
                                        approve request?')'> <i class='fa fa-check text-success' style='font-size:40px'></i> Dean</a>";
                                    }else if($status==1) {
                                        echo "<a href='approve-item.php?id={$result2['request_id']}&&editable=1'
                                        onclick='confirm('Do you want to
                                        approve request?')'> <i class='fa fa-check text-success' style='font-size:40px'></i> VC</a>";
                                    } else if($status==2) {
                                        echo "<a href='approve-item.php?id={$result2['request_id']}&&editable=2'
                                onclick='confirm('Do you want to
                                approve request?')'> <i class='fa fa-check text-success' style='font-size:40px'></i> Bursary</a>";
                                    }else if($status==3){
                                        echo "<a href='approve-item.php?id={$result2['request_id']}&&editable=3'
                                        onclick='confirm('Do you want to
                                        approve request?')'> <i class='fa fa-check text-success' style='font-size:40px'>Store Keeper</i></a>";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php $i++;} }else{
                            echo "<tr> <td colspan='8' class='text-center'>No new request made</td><</tr>";
                        } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?php include_once("../inc/footer.php"); ?>
</body>

</html>