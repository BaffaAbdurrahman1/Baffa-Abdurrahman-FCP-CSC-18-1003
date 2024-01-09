<?php
    if($role=="Vice chancellor"){
        echo "<a href='vc-dashboard.php' class='nav-item nav-link text-success'>Previous</a>";   
    }else if($role=="Head of department"){
        echo "<a href='hod-dashboard.php' class='nav-item nav-link text-success'>Previous</a>";
    }else if($role=="Dean"){
        echo "<a href='dean-dashboard.php' class='nav-item nav-link text-success'>Previous</a>";
    }else if($role=="Bursary"){
        echo "<a href='bursary-dashboard.php' class='nav-item nav-link text-success'>Previous</a>";
    }else{
        echo "<a href='storeKeeper-dashboard.php' class='nav-item nav-link text-success'>Previous</a>";
    }