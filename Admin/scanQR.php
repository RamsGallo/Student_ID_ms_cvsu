
<?php 
error_reporting(0);
//require_once('../../autoload.php');
include '../Includes/dbcon.php';
include '../Includes/session.php';
include '../phpqrcode/qrlib.php';
include 'config.php';
    

//------------------------SAVE--------------------------------------------------

if(isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "generate"){

  $tempDir = '../temp/'; 
  $codeContents="Hello"+"908";
  $fileName = '005_file_'.md5($codeContents).'.png';
  
  $pngAbsoluteFilePath = $tempDir.$fileName;
  $urlRelativeFilePath = $tempDir.$fileName;

  if (!file_exists($pngAbsoluteFilePath)) {
    QRcode::png($codeContents, $pngAbsoluteFilePath);
    echo 'File generated! Image file stored in your local drive.';
    
  } else {
    echo 'QR code already generated! We can use this cached file to speed up site on common codes!';
    
  }

  echo 'Server PNG File: '.$pngAbsoluteFilePath;
  echo '<hr />';
  echo '<img src="'.$urlRelativeFilePath.'" />';
}
  //QRcode::png($state, $tempDir.''.$state.'.png', QR_ECLEVEL_L, 5);

//--------------------EDIT------------------------------------------------------------

 if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit"){
  $tempDir = '../temp/'; 
  $imgDir = '../img/';
  $Id = $_GET['Id'];
  
  $codeContents=$queryAdmission.$queryLName.$queryFName;
  $fileName = '000_file_'.md5($codeContents).'.png';
  $imgName = $queryLName.$queryAdmission.'.png';
  $idname = $queryAdmission.'_ID.png';
  
  $pngAbsoluteFilePath = $tempDir.$fileName;
  $urlRelativeFilePath = $tempDir.$fileName;
  $urlImageFilePath = $imgDir.$imgName;
  $codeContents = $fileName;

  if (!file_exists($pngAbsoluteFilePath)) {
    QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 5);
    $qrgenerated = 'QR code generated!';
  } else {
    $alreadyexist = 'QR code already generated! This QR code file exists in your local drive.';
  }
  // echo 'Server HASHED File: '.$pngAbsoluteFilePath;
  // echo '<hr />';
  // echo 'Name: '.$queryFName.'&nbsp'.$queryLName;
  // echo '<hr />';
  // echo '<img src="'.$urlRelativeFilePath.'" />';
    
  }


//--------------------------------DELETE------------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];
        $classArmId= $_GET['classArmId'];

        $query = mysqli_query($conn,"DELETE FROM tblstudents WHERE Id='$Id'");

        if ($query == TRUE) {

            echo "<script type = \"text/javascript\">
            window.location = (\"createStudents.php\")
            </script>";
        }
        else{

            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Deletion Failed. An error occurred!</div>"; 
         }
      
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Scan QR for Students</title>
  <link href="img/logo/attnlg.jpg" rel="icon">
  <?php include 'includes/title.php';?>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <style>
        .row {
            overflow-x:scroll;
        }
        .id-body {
          box-shadow: 0 8px 8px 10px rgba(87, 84, 84, 0.4);
            max-width: 250px;
            max-height: 300px;
            padding: 10px;
            margin: auto;
            text-align: center;
          
        }
        p1 {
          
        }
        .qr-img{
          
        }
        .profile-img{
          width: 130px;
          height: 130px;
          border: 4px solid black;
          border-radius: 50%;
          font-size: 100px;
          margin: auto;
        }
        .mother {
          display: grid;
          grid-template-columns: 50% 50%;
          grid-gap: 15px;
        }
        .id-content{
          box-shadow: 0 10px 10px 1px rgba(87, 84, 84, 0.4);
          max-width: 100%;
          padding: 10px;
          margin-top: 13px;
          text-align: center;
          background-image: url("../img/logo/cvsu.png");
          background-size: 350px;
          background-repeat: no-repeat;
          background-position: bottom;
          color: black;
          border-style: solid;
          border-color: black;
          border-width: thin;
          border-radius: 12px;
        }
    </style>

   <script>
    function classArmDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxClassArms2.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>

<script>
    function classStudentDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxStudents.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">QR Code Reader</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Controls List</li>
              <li class="breadcrumb-item active" aria-current="page">QR Code for Students</li>
            </ol>
          </div>

          <div>
          <div class="mother">
          <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Scan QR for validation</h6>
                    <?php echo $statusMsg; ?>
                    <?php echo $statusIn; ?>
                </div>
                <div class="card-body">
                  <?php 
                   echo 'Note: Please allow camera access to use the scanner.';
                   echo '<hr />';
                   ?>
                   <video id='preview' width="100%"></video>
                   <script>
                    let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
                    Instascan.Camera.getCameras().then(function(cameras){
                        if(cameras.length > 0){
                            scanner.start(cameras[0]);
                        }
                        else{
                            alert("No camera found!");
                        }
                    }).catch(function(e){
                        console.error(e);
                    });
                    scanner.addListener('scan', function(c){
                        document.getElementById('text').value=c;
                        document.forms[0].submit();
                    })
                   </script>
                </div>
              </div>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <button class="btn btn-primary" type="button" id="print-card"><i class="fa fa-print"></i>&nbsp&nbsp&nbspPrint File</button>
                  <!-- <button class="btn btn-primary" type="button" id="image-card"><i class="fa fa-image"></i>&nbsp&nbsp&nbspSave as Image</button>
                    <?php //echo $statusMsg; ?>
                    <?php //echo $statusIn; ?> -->
                </div>
                <div class="card-body" id="id-body">
                    <form action="insertQR.php" method="post">
                        <input type="text" name="text" id="text" class="form-control">
                    </form>

                  <div id="record-content">
                  <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light" id="table">
                      <tr>
                        <th>#</th>
                        <th>isVALID?</th>
                        <th>Stud. #</th>
                        <th>QR INFO</th>
                        <th>TIME</th>
                      </tr>
                    </thead>
                
                    <tbody>

                  <?php
                      $query = "SELECT tblqrscanned.qrExists, tblqrscanned.handler,tblqrscanned.qrinfo, tblqrscanned.date_scanned
                      FROM tblqrscanned";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td><b>".$rows['qrExists']."</b></td>
                                <td><b>".$rows['handler']."</b></td>
                                <td>".$rows['qrinfo']."</td>
                                <td>".$rows['date_scanned']."</td>
                               
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                    </tbody>
                  </table>
                </div>
                    </div>
                   </div>
                </div>
              </div>
</div>
              
              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Echo All Students</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>F Name</th>
                        <th>L Name</th>
                        <th>Other Name</th>
                        <th>Admission #</th>
                        <th>Program</th>
                        <th>Class Arm</th>
                        <th>Date Created</th>
                        <th>Guardian Name</th>
                        <th>Guardian Contact #</th>
                        <th>Home Address</th>
                        <th>QR Hash</th>
                      </tr>
                    </thead>
                
                    <tbody>

                  <?php
                      $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
                      tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber,tblstudents.dateCreated,tblstudents.guardian,tblstudents.guardianNo,tblstudents.homeaddress, tblstudents.qrHashPath
                      FROM tblstudents
                      INNER JOIN tblclass ON tblclass.Id = tblstudents.classId
                      INNER JOIN tblclassarms ON tblclassarms.Id = tblstudents.classArmId";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['otherName']."</td>
                                <td>".$rows['admissionNumber']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['classArmName']."</td>
                                <td>".$rows['dateCreated']."</td>
                                <td>".$rows['guardian']."</td>
                                <td>".$rows['guardianNo']."</td>
                                <td>".$rows['homeaddress']."</td>
                                <td>".$rows['qrHashPath']."</td>
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          <!--Row-->

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    saveBtn = document.querySelector("#image-card");
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });

    $('#print-card').click(function(){
		var ccts = $('#record-content').clone()

		var nw = window.open('','_blank','height=500,width=800');
		nw.document.write(ccts.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			window.close()
		},750)});
    
  </script>
  
  
<!-- ------------------------------------ -->
</div>
</body>

</html>