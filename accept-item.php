<?php
    session_start();
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
    require_once("../inc/connect.php");
   
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        //echo $delete; 
        $collection_date=date('d-m-Y');
        //Fetch item from the item table to reduce it inventory
        $item_id=$_GET["item_id"];
        $sql1="SELECT * FROM item WHERE item_id='$item_id'";
        $query1=mysqli_query($con, $sql1);
        $result1=mysqli_fetch_array($query1);
        $store_qty=$result1["store_qty"];
        $qty=$_GET["qty"];
        $new_qty=$store_qty-$qty;
        $sql="UPDATE request SET collection_date='$collection_date', request_status='5' WHERE request_id='$id'";
        $query=mysqli_query($con, $sql);
        $sql3="UPDATE item SET store_qty='$new_qty' WHERE item_id='$item_id'";
        $query3=mysqli_query($con, $sql3);
        if($query){
            echo "<script> 
                alert('Item accepted successfully');
                document.location.href='accept-item.php';
                </script>";
        }else{
            echo "<script> alert('Fail to accept item')</script>";
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
                    <a href="hod-dashboard.php" class="nav-item nav-link text-success">Previous</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    Accept quantity supllied
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
                            <th>Accept item</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //0 just sent by hod, 1 approved by dean, 2 approve by vc, 3 approve by bursary, 4 approve by store
                            //5 approve by hod. Now collection date should be updated 
                            $i=1;
                            $sql2="SELECT * FROM request r INNER JOIN staff s ON r.emp_num=s.emp_num INNER JOIN department d ON s.dept_id=d.dept_id 
                            INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id INNER JOIN item i ON r.item_id=i.item_id
                            WHERE s.emp_num='$user' AND r.request_status=4";
                            $query2=mysqli_query($con, $sql2);
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
                                    //echo "Processing";
                                }else{
                                    echo "<td class='bg-success text-white'>Approved</td>";  
                                }
                            ?>

                            <td>
                                <?php
                                    if($status==1 || $status==2 || $status==3) {
                                        echo "{$status}Request still in process";
                                    }else if($status==4){
                                      echo "<a href='accept-item.php?id={$result2['request_id']}&&item_id={$result2['item_id']}&&qty={$result2['qty']}'
                                onclick='confirm('Do you want to
                                verify supply?')'> <i class='fa fa-check text-danger' style='font-size:40px'></i></a>";
                                }else if($status==5){
                                echo "Item has been collected";
                                }
                                ?>
                            </td>
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