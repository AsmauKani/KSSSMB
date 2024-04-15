<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'])==0) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $StaffName=$_POST['StaffName'];
    $Staffemail=$_POST['Staffemail'];
    $Gender=$_POST['Gender'];
    $UserName=$_POST['uname'];
    $password=md5($_POST['password']);
    
    $ret="SELECT UserName FROM tblstaff WHERE UserName=:uname";
    $query= $dbh->prepare($ret);
    $query->bindParam(':uname',$UserName,PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() == 0) {
      $sql="INSERT INTO tblstaff(StaffName, StaffEmail, Gender, UserName, Password) VALUES(:StaffName, :Staffemail, :Gender, :UserName, :password)";
      $query=$dbh->prepare($sql);
      $query->bindParam(':StaffName',$StaffName,PDO::PARAM_STR);
      $query->bindParam(':Staffemail',$Staffemail,PDO::PARAM_STR);
      $query->bindParam(':Gender',$Gender,PDO::PARAM_STR);
      $query->bindParam(':UserName',$UserName,PDO::PARAM_STR);
      $query->bindParam(':password',$password,PDO::PARAM_STR);
      $query->execute();
      $LastInsertId=$dbh->lastInsertId();
      if ($LastInsertId>0) {
        echo '<script>alert("Staff has been added.")</script>';
        echo "<script>window.location.href ='add-staffs.php'</script>";
      } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
      }
    } else {
      echo "<script>alert('Username already exists. Please try again');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Management System || Add Staffs</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/select2/select2.min.css">
  <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Add Staffs </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Staffs</li>
              </ol>
            </nav>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="text-align: center;">Add Staff</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputName1">Staff Name</label>
                      <input type="text" name="StaffName" value="" class="form-control" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Staff Email</label>
                      <input type="text" name="Staffemail" value="" class="form-control" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Gender</label>
                      <select name="Gender" class="form-control" required='true'>
                        <option value="">Choose Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">User Name</label>
                      <input type="text" name="uname" value="" class="form-control" required='true'>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Password</label>
                      <input type="Password" name="password" value="" class="form-control" required='true'>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include_once('includes/footer.php');?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/select2/select2.min.js"></script>
  <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="js/typeahead.js"></script>
  <script src="js/select2.js"></script>
  <!-- End custom js for this page -->
</body>
</html>
