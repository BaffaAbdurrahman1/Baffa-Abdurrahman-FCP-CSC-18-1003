<?php
    session_start();
    $user=$_SESSION["user_id"];
    if($user==""){
        header("LOCATION:login.php");
    }
    require_once("../inc/connect.php");
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
            $sql1="INSERT INTO request (item_id, emp_num, qty, request_date, collection_date, dept_id, fact_id, `request_status`) 
            VALUES('$item_id', '$user', '$qty', '$request_date','','$dept_id', $fact_id,'0')";
            //0 just sent by hod, 1 approved by dean, 2 approve by vc, 3 approve by bursary, 4 approve by store
            //5 approve by hod. Now collection date should be updated 
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
                    <a href="hod-dashboard.php" class="nav-item nav-link text-success">Previous</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 border mb-3 shadow" style="margin:0 auto">
                <h3 class="text-center text-success">
                    Send Item Request Form
                </h3>
                <?php
                    //Fetch staff record from staff table use inner join to display fact and dept then use where 
                    //clause to get only staff with log id
                    $sql2="SELECT * FROM staff s INNER JOIN department d ON s.dept_id=d.dept_id 
                    INNER JOIN faculty f ON f.fact_id=s.fact_id INNER JOIN position p ON p.post_id=s.post_id
                    WHERE s.emp_num='$user'";
                    $query2=mysqli_query($con, $sql2);
                    $result2=mysqli_fetch_array($query2);
                    
                ?>
                <form action="" method="post" style="" class="pt-4 pb-4">
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Full name:
                        </label>
                        <div class="col-8">
                            <input type="text" name="" class="form-control" readonly
                                value="<?php echo $result2['full_name']; ?>">

                        </div>
                    </div>
                    <input type="hidden" name="dept_id" value="<?php echo $result2['dept_id']; ?>">
                    <input type="hidden" name="fact_id" value="<?php echo $result2['fact_id']; ?>">
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Department:
                        </label>
                        <div class="col-8">
                            <input type="text" name="" class="form-control" readonly
                                value="<?php echo $result2['dept_name']; ?>">
                        </div>
                    </div>
                    <div class=" form-group row">
                        <label for="" class="col-4 col-form-label">
                            Faculty:
                        </label>
                        <div class="col-8">
                            <input type="text" name="" class="form-control" readonly
                                value="<?php echo $result2['fact_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Position:
                        </label>
                        <div class="col-8">
                            <input type="text" name="" required class="form-control" readonly
                                value="<?php echo $result2['post_name']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Item name
                        </label>
                        <div class="col-8">
                            <select name="item_id" id="item_id" class="custom-select">
                                <option value="0">[--Select Item--]</option>
                                <?php
                                    $sql3="SELECT * FROM item";
                                    $query3=mysqli_query($con, $sql3);
                                    while($result3=mysqli_fetch_array($query3)){
                                ?>
                                <option value=" <?php echo $result3['item_id']; ?>">
                                    <?php echo $result3['item']; ?>
                                </option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Available Quantity
                        </label>
                        <div class="col-8">
                            <input type="text" readonly id='store_qty' name="store_qty" required class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-4 col-form-label">
                            Request Quantity
                        </label>
                        <div class="col-8">
                            <input type="text" name="qty" required class="form-control" placeholder="">
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

    <?php include_once("../inc/footer.php"); ?>
    <script src="../js/jquery.js"></script>
    <script>
    $(document).ready(function() {
        $('#item_id').change(function() {
            var item_id = $('#item_id').val();
            //alert(item_id);
            if (item_id != 0) {
                //alert(item_id);
                $.ajax({
                    type: 'POST',
                    url: 'populate-qty.php',
                    cache: false,
                    data: {
                        id: item_id
                    },
                    success: function(response) {
                        //alert(response);
                        //var res = trim(response);
                        $("#store_qty").val(response);
                    }
                });
            } else {
                alert('Invalid selection');
            }
        });
    });
    </script>
</body>

</html>