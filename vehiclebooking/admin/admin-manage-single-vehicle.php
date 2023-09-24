<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['a_id'];
  //Add USer
  if(isset($_POST['upate_veh']))
    {
            $v_id = $_GET['v_id'];
            $v_name=$_POST['v_name'];
            $v_reg_no = $_POST['v_reg_no'];
            $v_category=$_POST['v_category'];
            //$v_dpic=$_POST['v_dpic'];
            $v_status=$_POST['v_status'];
            $v_driver=$_POST['v_driver'];
            $v_dpic=$_FILES["v_dpic"]["name"];
            move_uploaded_file($_FILES["v_dpic"]["tmp_name"],"../vendor/img/".$_FILES["v_dpic"]["name"]);
            $query="update tms_vehicle set v_name=?, v_reg_no=?, v_driver=?, v_category=?, v_dpic=?, v_status=? where v_id = ?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('ssssssi', $v_name, $v_reg_no, $v_driver, $v_category, $v_dpic, $v_status, $v_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Vehicle Updated";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
            }
?>
<!DOCTYPE html>
<html lang="en">

<?php include('vendor/inc/head.php');?>

<body id="page-top">
 <!--Start Navigation Bar-->
  <?php include("vendor/inc/nav.php");?>
  <!--Navigation Bar-->

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("vendor/inc/sidebar.php");?>
    <!--End Sidebar-->
    <div id="content-wrapper">

      <div class="container-fluid">
      <?php if(isset($succ)) {?>
                        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success!","<?php echo $succ;?>!","success");
                    },
                        100);
        </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed!","<?php echo $err;?>!","Failed");
                    },
                        100);
        </script>

        <?php } ?>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Vehicles</a>
          </li>
          <li class="breadcrumb-item active">Update Vehicle</li>
        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
            Update Vehicle
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['v_id'];
            $ret="select * from tms_vehicle where v_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <form method ="POST" enctype="multipart/form-data"> 
            <div class="form-group">
                <label for="exampleInputEmail1">Vehicle Name</label>
                <input type="text" value="<?php echo $row->v_name;?>" required class="form-control" id="exampleInputEmail1" name="v_name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Vehicle Registration Number</label>
                <input type="text" value="<?php echo $row->v_reg_no;?>" class="form-control" id="exampleInputEmail1" name="v_reg_no">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Driver</label>
                <input type="text" value="<?php echo $row->v_driver;?>" class="form-control" id="exampleInputEmail1" name="v_driver">
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlSelect1">Vehicle Category</label>
              <select class="form-control" name="v_category" id="exampleFormControlSelect1">
                <option>Bus</option>
                <option>Matatu</option>
                <option>Nissan</option>

              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlSelect1">Vehicle Status</label>
              <select class="form-control" name="v_status" id="exampleFormControlSelect1">
                <option>Booked</option>
                <option>Available</option>
              </select>
            </div>

            <div class="card form-group" style="width: 30rem">
            <img src="../vendor/img/<?php echo $row->v_dpic;?>" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title">Vehicle Picture</h5>
                <input type="file" class="btn btn-success" id="exampleInputEmail1" name="v_dpic">
            </div>
            </div>
            <hr>
            <button type="submit" name="upate_veh" class="btn btn-success">Update Vehicle</button>
          </form>
          <!-- End Form-->
          <?php }?>
        </div>
      </div>
       
      <hr>
     

      <!-- Sticky Footer -->
      <?php include("vendor/inc/footer.php");?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="admin-logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="vendor/js/demo/datatables-demo.js"></script>
  <script src="vendor/js/demo/chart-area-demo.js"></script>
 <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
