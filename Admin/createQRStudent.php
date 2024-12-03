
        <?php 
        error_reporting(0);
        //require_once('../../autoload.php');
        include '../Includes/dbcon.php';
        include '../Includes/session.php';
        include '../phpqrcode/qrlib.php';
        include 'vendor/chillerlan/php-qrcode/src/QRCode.php';
        include 'vendor/chillerlan/php-qrcode/src/QROptions.php';
        include 'config.php';
        //require_once __DIR__.'/../vendor/autoload.php';

//------------------------SAVE--------------------------------------------------

if(isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "generate"){

  $tempDir = '../temp/'; 
  $codeContents="Hello"+"908";
  $fileName = '000_file_'.md5($codeContents).'.png';
  
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
  
  $queryAdmission = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['admissionNumber'];
  $queryFName = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['firstName'];
  $queryLName = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['lastName'];
  $queryProgram = $conn->query("SELECT * FROM tblclass INNER JOIN tblstudents ON tblclass.Id=tblstudents.classID AND tblstudents.Id='$Id'")->fetch_array()['className'];

  $queryClassarm = $conn->query("SELECT * FROM tblclassarms INNER JOIN tblstudents ON tblclassarms.Id=tblstudents.classArmId AND tblstudents.Id='$Id'")->fetch_array()['classArmName'];

  $queryGuardian = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['guardian'];
  $queryNo = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['guardianNo'];
  $queryAddress = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['homeaddress'];
  $queryImage = $conn->query("SELECT * FROM tblstudents WHERE Id='$Id'")->fetch_array()['studentimg'];

  $codeContents=$queryAdmission.$queryLName.$queryFName;
  $fileName = '000_file_'.md5($codeContents).'.png';
  $imgName = $queryLName.$queryAdmission.'.png';
  $idname = $queryAdmission.'_ID.png';

  move_uploaded_file($queryImage, __DIR__.'../img/'. $queryLName.$queryAdmission);
  
  $pngAbsoluteFilePath = $tempDir.$fileName;
  $urlRelativeFilePath = $tempDir.$fileName;
  $urlImageFilePath = $imgDir.$imgName;
  $codeContents = $fileName;

  if (!file_exists($pngAbsoluteFilePath)) {
    QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 5);
    //$qrcode = (new QRCode)->render($codeContents, $pngAbsoluteFilePath);
    //png($queryImage, $tempDir);
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
  <title>Generate QR for Students</title>
  <link href="img/logo/attnlg.jpg" rel="icon">
  <?php include 'includes/title.php';?>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Train+One&display=swap" rel="stylesheet">
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
        .p1
        {
          color: white;
        }
        .mark3, mark3
        {
          background-color: rgba(0,0,139,.5);
          border-radius: 20px;
          color: white;
          padding: 0em 0.4em 0em 0.4em;
        }
        .mark2, mark2
        {
          padding: 0em 0.2em 0em 0.2em;
          background-color: rgba(255,255,255,.5);
          border-radius: 50px;
        }
        .mark, mark
        {
          padding: 0em 0.1em 0em 0.1em;
          background-color: rgba(255,255,255,.3);
          border-radius: 0px;
        }
        .qr-img
        {
          height: 130px;
          width: 130px;
          border-style: groove;
          border-color: #B59410;
          border-radius: 10px;
        }
        .cvsu-header-id
        {
          background-color: green;
          border-radius: 50px
        }
        .cvsu-header-id2
        {
          background-color: darkblue;
          border-radius: 20px;
          display: in-line block;
        }
        .cvsu-header-text
        {
          color: white;
          font-family: "Poppins", sans-serif;
          font-weight: 300;
          font-style: normal;
        }
        .cvsu-text
        {
          color: black;
          background-color: white;
          border-radius: 3px;
        }
        .profile-img
        {
          width: 130px;
          height: 130px;
          border: 4px solid black;
          border-radius: 50%;
          font-size: 100px;
          margin: auto;
        }
        .mother {
          display: grid;
          grid-template-columns: 30% 70%;
          grid-gap: 13px;
        }
        .id-content-1{
          box-shadow: 0 10px 10px 1px rgba(87, 84, 84, 0.4);
          max-width: 350px;
          height: 506px;
          width: 319px;
          padding: 15px;
          margin: auto;
          text-align: center;
          background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url("../img/logo/cvsu.png");
          background-size: 700px;
          background-repeat: no-repeat;
          background-position: top;
          color: black;
          border-style: solid;
          border-color: black;
          border-width: thin;
          border-radius: 10px;
        }

        .id-content-2{
          box-shadow: 0 10px 10px 1px rgba(87, 84, 84, 0.4);
          max-width: 350px;
          height: 506px;
          width: 319px;
          padding: 15px;
          margin: auto;
          text-align: center;
          background-image: url("../img/logo/cvsu.png");
          background-size: 700px;
          background-repeat: no-repeat;
          background-position: top;
          color: black;
          border-style: solid;
          border-color: black;
          border-width: thin;
          border-radius: 10px;
        }
        .wrap-card-body
        {
          display: grid;
          grid-template-columns: 50% 50%;
          grid-column-gap: 1px;
          overflow-y: hidden;
          overflow-x: auto;
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
            <h1 class="h3 mb-0 text-gray-800">Generate QR Code for Students</h1>
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
                  <h6 class="m-0 font-weight-bold text-primary">View | Export QR code for Student</h6>
                    <?php echo $statusMsg; ?>
                    <?php echo $statusIn; ?>
                </div>
                <div class="card-body">
                  <?php 
                   echo 'Status: ';
                   echo $qrgenerated;
                   echo $alreadyexist;
                   echo '<hr />';
                   echo '<p><b>ADMIN ONLY. Keep hashed file name private!</b></p>';
                   echo 'Local HASHED File Path: <b>'.$pngAbsoluteFilePath.'</b>&nbsp&nbsp';
                   echo '<hr />';
                   echo '<p>Student Name: <b>'.$queryLName.', '.$queryFName.'</b></p>';
                   echo '<p>Student Contact No.: <b>'.$queryAdmission.'</b></p>';
                   echo '<p>Student Program: <b>'.$queryProgram.'</b></p>';
                   echo '<p>Student Section: <b>'.$queryClassarm.'</b></p>';
                   echo '<p>Guardian Name: <b>'.$queryGuardian.'</b>&nbsp(Guardian)</p>';
                   echo '<p>Home Address: <b>'.$queryAddress.'</b>&nbsp </p>';
                   echo '<p>Guardian Contact No.: <b>'.$queryNo.'</b>&nbsp </p>';
                   echo '<p><b><i>*Click the eye icon to view student IDs</p></b></i>';
                   ?>
                   
                </div>
              </div>
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <button class="btn btn-primary" type="button" id="print-card"><i class="fa fa-print"></i>&nbsp&nbsp&nbspPrint File</button>
                  <button class="btn btn-primary" type="button" id="image-card"><i class="fa fa-image"></i>&nbsp&nbsp&nbspSave as Image</button>
                    <?php echo $statusMsg; ?>
                    <?php echo $statusIn; ?>
                </div>
                <div class="card-body wrap-card-body" id="id-body">
                  <div class="id-content-1" id="id-content-front">
                    <?php
                      echo "<div class='cvsu-header-id'><h4 class='cvsu-header-text'>Cavite State University</h4></div>";
                      echo "<h6><mark3>BACOOR CITY CAMPUS</mark3></h6>";
                      echo "<hr>";
                      echo "<h5><mark2>$queryFName&nbsp$queryLName</mark2></h5>";
                      echo '<img class="profile-img" src="../img/'.$queryImage.'" />';
                      echo "<p class='p1'><b>$queryAdmission</b></p>";
                      echo "<p><mark>$queryProgram, $queryClassarm</mark></p>";
                      echo '<img class="qr-img" src="'.$urlRelativeFilePath.'" />';
                      ?>
                  </div>
                  <div class="id-content-2" id="id-content-back">
                    <?php
                      echo "<div class='cvsu-header-id'><h4 class='cvsu-header-text'>Cavite State University</h4></div>";
                      echo "<hr>";
                      echo "In case of emergency, please contact:";
                      echo "<p></p>";
                      echo "<h3><mark2>$queryGuardian</mark2></h3>";
                      echo "<p>address: <mark><b>$queryAddress</b></mark></p>";
                      echo "<p>contact no.: <mark><b>$queryNo</b></mark></p>";
                      echo "<hr>";
                      echo "<p>$queryProgram, $queryClassarm</p>";
                      echo "<div class='cvsu-header-id2'><h6 class='cvsu-header-text'>BACOOR CITY CAMPUS</h6></div>";
                      echo "<p>THIS <b><u>SCHOOL IDENTIFICATION CARD</b></u> IS NON <b>TRANSFERRABLE</b>.<br> IT MUST BE WORN ON AT ALL TIMES WHILE INSIDE THE UNIVERSITY PREMISES.</p>";
                      ?>
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
                        <th>QR ID</th>
                      </tr>
                    </thead>
                
                    <tbody>

                  <?php
                      $query = "SELECT tblstudents.Id,tblclass.className,tblclassarms.classArmName,tblclassarms.Id AS classArmId,tblstudents.firstName,
                      tblstudents.lastName,tblstudents.otherName,tblstudents.admissionNumber,tblstudents.dateCreated,tblstudents.guardian,tblstudents.guardianNo,tblstudents.homeaddress
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
                                <td><a href='?action=edit&Id=".$rows['Id']."'><i class='fas fa-fw fa-eye'></i> View ID</a>
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
  <script src="../vendor/html2canvas.js"></script>
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
		var ccts = $('#id-body').clone()

		var nw = window.open('','_blank','height=500,width=800');
		nw.document.write(ccts.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			window.close()
		},750)});
    
    $('#image-card').click(function() {
      html2canvas(document.querySelector("#id-body")).then(canvas => {
        canvas.style.display = 'none'
            document.body.appendChild(canvas)
            return canvas
        })
        .then(canvas => {
            let name = 'ID_<?php echo $imgName ?>';
            const image = canvas.toDataURL('image/png')
            const a = document.createElement('a')
            a.setAttribute('download', name)
            a.setAttribute('href', image)
            a.click()
            canvas.remove()
        })
      });
  </script>
  
  
<!-- ------------------------------------ -->
</div>
</body>

</html>