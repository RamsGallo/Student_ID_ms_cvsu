<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';

if(isset($_POST['text'])){
    $qrinfo=$_POST['text'];
    
    $queryValid = $conn->query("SELECT Id FROM tblstudents WHERE qrHashPath='$qrinfo'");
    
    $queryAdmission = $conn->query("SELECT * FROM tblstudents WHERE qrHashPath='$qrinfo'")->fetch_array()['admissionNumber'];
    
    if (!(mysqli_num_rows($queryValid)==0)){
        $sql = "INSERT INTO tblqrscanned(qrExists,handler,qrinfo,date_scanned) VALUES ('VALID','$queryAdmission','$qrinfo',now())";
        if($conn->query($sql)===TRUE){
        $success = "Record inserted successfully.";
        }
        else{
        $unsuccess="Insert unsuccessful.".$conn->error;
        }
        header("location: scanQR.php");

    } else {
        $sql = "INSERT INTO tblqrscanned(qrExists,handler,qrinfo,date_scanned) VALUES ('INVALID','not_found','$qrinfo',now())";
        if($conn->query($sql)===TRUE){
        $success = "Record inserted successfully.";
        }
        else{
        $unsuccess="Insert unsuccessful.".$conn->error;
        }
        header("location: scanQR.php");
    }
}
$conn->close();


?>