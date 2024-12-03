<?php

include '../Includes/dbcon.php';

    $cid = intval($_GET['cid']);//

        $queryss=mysqli_query($conn,"select * from tblstudents where classId=".$cid."");                        
        $countt = mysqli_num_rows($queryss);

        echo '
        <select required name="setId" class="form-control mb-3">';
        echo'<option value="">--select student--</option>';
        while ($row = mysqli_fetch_array($queryss)) {
        echo'<option value="'.$row['Id'].'" >'.$row['admissionNumber'].'</option>';
        }
        echo '</select>';
?>

