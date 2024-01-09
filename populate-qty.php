<?php
    require_once("../inc/connect.php");
    $item_id=$_POST["id"];
    //echo $item_id."I";
    $sql="SELECT * FROM item WHERE item_id='$item_id'";
    $query=mysqli_query($con, $sql);
    $result=mysqli_fetch_array($query);
    $qty=$result['store_qty'];
    echo $qty;
    