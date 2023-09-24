<?php
  session_start();
  include('vendor/inc/config.php');
  include('vendor/inc/checklogin.php');
  check_login();
  $aid=$_SESSION['a_id'];
  //Add Booking
  if(isset($_POST['publish_feedback']))
    {
            $f_id = $_GET['f_id'];
            $f_status  = $_POST['f_status'];
            $query="update tms_feedback set  f_status=? where f_id=?";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('si',  $f_status, $f_id);
            $stmt->execute();
                if($stmt)
                {
                    $succ = "Feedback Published";
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
            <a href="#">Feedbacks</a>
          </li>
          <li class="breadcrumb-item">Manage</li>
          <li class="breadcrumb-item active">Publish</li>

        </ol>
        <hr>
        <div class="card">
        <div class="card-header">
          Publish Feedback
        </div>
        <div class="card-body">
          <!--Add User Form-->
          <?php
            $aid=$_GET['f_id'];
            $ret="select * from tms_feedback where f_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$aid);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
            <form method ="POST"> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Name</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $row->f_uname;?>" id="exampleInputEmail1" name="f_uname">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Client Testimonial</label>
                    <textarea type="text" class="form-control" readonly placeholder = "Give Your Feedback" id="exampleInputEmail1" name="f_content"><?php echo $row->f_content;?></textarea>
                </div>

                <div class="form-group">
                <label for="exampleFormControlSelect1">Publish Status</label>
                <select class="form-control" name="f_status" id="exampleFormControlSelect1">
                    <option>Published</option>
                    <option>Pending</option>
                </select>
                </div>

                <button type="submit" name="publish_feedback" class="btn btn-success">Publish</button>
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
