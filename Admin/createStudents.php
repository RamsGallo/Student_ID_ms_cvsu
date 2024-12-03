
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';
include '../phpqrcode/qrlib.php';
include 'config.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
  $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $otherName=$_POST['otherName'];

  $admissionNumber=$_POST['admissionNumber'];
  $classId=$_POST['classId'];
  $classArmId=$_POST['classArmId'];
  $dateCreated = date("Y-m-d");

  $guardian=$_POST['guardian'];
  $guardianNo=$_POST['guardianNo'];
  $homeaddress=$_POST['homeaddress'];

  $image = $_POST['studentimg'];

  $imgdir = '../img/';

  $fileImgName = $_FILES["studentimg"]['name'];
  $fileImgSize = $_FILES["studentimg"]['size'];
  $fileImgTemp = $_FILES["studentimg"]['tmp_name'];
  $filenameset = $lastName.$admissionNumber;

  


  $tempDir = '../temp/'; 

  $codeContents=$admissionNumber.$lastName.$firstName;
  $fileName = '000_file_'.md5($codeContents).'.png';
  
  $pngAbsoluteFilePath = $tempDir.$fileName;
  $urlRelativeFilePath = $tempDir.$fileName;
  $codeContents = $fileName;

  $qrHashPath=$codeContents;
   
    $query=mysqli_query($conn,"select * from tblstudents where admissionNumber ='$admissionNumber'");
    $ret=mysqli_fetch_array($query);

    if($ret > 0){ 

        $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>This Admission Number already exists!</div>";
    }
    else{
    //QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 5);
    $query=mysqli_query($conn,"insert into tblstudents(firstName,lastName,otherName,admissionNumber,password,classId,classArmId,dateCreated,guardian,guardianNo, homeaddress,qrHashPath,studentimg)
    value('$firstName','$lastName','$otherName','$admissionNumber','12345','$classId','$classArmId','$dateCreated', '$guardian', '$guardianNo', '$homeaddress','$qrHashPath','$image')");

    if ($query) {
        
        $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Created Successfully!</div>";
            
    }
    else
    {
         $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
    }
  }
}

//--------------------EDIT------------------------------------------------------------

 if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "edit")
	{
        $Id= $_GET['Id'];

        $query=mysqli_query($conn,"select * from tblstudents where Id ='$Id'");
        $row=mysqli_fetch_array($query);

        //------------UPDATE-----------------------------

        if(isset($_POST['update'])){
    
             $firstName=$_POST['firstName'];
  $lastName=$_POST['lastName'];
  $otherName=$_POST['otherName'];

  $admissionNumber=$_POST['admissionNumber'];
  $classId=$_POST['classId'];
  $classArmId=$_POST['classArmId'];
  $dateCreated = date("Y-m-d");

  $guardian=$_POST['guardian'];
  $guardianNo=$_POST['guardianNo'];
  $homeaddress=$_POST['homeaddress'];

  $image = $_POST['studentimg'];

 $query=mysqli_query($conn,"update tblstudents set firstName='$firstName', lastName='$lastName',
    otherName='$otherName', admissionNumber='$admissionNumber',password='12345', classId='$classId',classArmId='$classArmId',guardian='$guardian', guardianNo='$guardianNo',homeaddress='$homeaddress', studentimg='$image',
    where Id='$Id'");
            if ($query) {
                echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php\")
                </script>"; 
            }
            else
            {
                $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }
        }
    }


//--------------------------------DELETE------------------------------------------------------------------

  if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];
        $classArmId= $_GET['classArmId'];

        $firstName = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['firstName'];
        $lastName = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['lastName'];
        $otherName = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['otherName'];
        $admissionNumber = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['admissionNumber'];
        $classId = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['classId'];
        $classArmId = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['classArmId'];
        $dateCreated = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['dateCreated'];
        $guardian = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['guardian'];
        $guardianNo = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['guardianNo'];
        $homeaddress = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['homeaddress'];
        $qrHashPath = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['qrHashPath'];
        $image = $conn->query("SELECT * FROM tblstudents WHERE id='$Id'")->fetch_array()['studentimg'];


        $query=mysqli_query($conn,"insert into tblstudentarchive(Id,firstName,lastName,otherName,admissionNumber,password,classId,classArmId,dateCreated,guardian,guardianNo,homeaddress,qrHashPath,studentimg)
        value('$Id','$firstName','$lastName','$otherName','$admissionNumber','12345','$classId','$classArmId','$dateCreated', '$guardian', '$guardianNo', '$homeaddress','$qrHashPath','$image')");

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
  <link href="img/logo/attnlg.jpg" rel="icon">
<?php include 'includes/title.php';?>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

  <style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
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
            <h1 class="h3 mb-0 text-gray-800">Students</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Manage Students</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Create or Update Student Profile</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                   <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Firstname<span class="text-danger ml-2">*</span></label>
                        <input type="text" required class="form-control" name="firstName" value="<?php echo $row['firstName'];?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Lastname<span class="text-danger ml-2">*</span></label>
                      <input type="text" required class="form-control" name="lastName" value="<?php echo $row['lastName'];?>" id="exampleInputFirstName" >
                        </div>
                    </div>
                     <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Other Name</label>
                        <input type="text" class="form-control" name="otherName" value="<?php echo $row['otherName'];?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Admission Number<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" required name="admissionNumber" value="<?php echo $row['admissionNumber'];?>" id="exampleInputFirstName" >
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Guardian Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" required class="form-control" name="guardian" value="<?php echo $row['guardian'];?>" id="exampleInputFirstName" >
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Guardian Contact No.<span class="text-danger ml-2">*</span></label>
                      <input type="text" required class="form-control" name="guardianNo" value="<?php echo $row['guardianNo'];?>" id="exampleInputFirstName" >
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Home Address<span class="text-danger ml-2">*</span></label>
                        <input type="text" required class="form-control" name="homeaddress" value="<?php echo $row['homeaddress'];?>" id="exampleInputFirstName" >
                        </div>
                      
                        <div class="col-xl-6">
                        <label class="form-control-label">Upload Profile Image<span class="text-danger ml-2">*</span></label>
                        <input type="file" required class="form-control" name="studentimg" value="<?php echo $row['studentimg'];?>" id="exampleInputFirstName" >
                    </div>

                    </div>
                    
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                        <label class="form-control-label">Select Program<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM tblclass ORDER BY className ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--select program--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['Id'].'" >'.$rows['className'].'</option>';
                              }
                                  echo '</select>';
                              }
                            ?>  
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Class Arm<span class="text-danger ml-2">*</span></label>
                            <?php
                                echo"<div required id='txtHint'></div>";
                            ?>
                        </div>
                    </div>
                  

                      <?php
                    if (isset($Id))
                    {
                    ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    } else {           
                    ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                    <?php
                    }         
                    ?>
                  </form>
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
                        <th>Configure</th>
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
                                <td><a href='?action=edit&Id=".$rows['Id']."'><i class='fas fa-fw fa-edit'></i></a>
                                <a onClick=\"javascript: return confirm('This student profile will be moved to the archive. Continue?');\" href='?action=delete&Id=".$rows['Id']."'><i class='fas fa-fw fa-trash'></a></td>;
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
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>