<?php
  //session_start();
  include('vendor/inc/config.php');
  if(isset($_POST['reset-pwd']))
    {
            $r_email= $_POST['r_email'];
            $query="INSERT INTO tms_pwd_resets (r_email) VALUES(?) ";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('s', $r_email);
            $stmt->execute();//ok
                if($stmt)
                {
                    $succ = "Password Reset Instruction Send To Your Email.";
                }
                else 
                {
                    $err = "Please Try Again Later";
                }
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Vehicle Booking System Transport Saccos, Matatu Industry">
  <meta name="author" content="MartDevelopers">

  <title>Vehicle Booking System | Admin - Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="vendor/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
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

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>

        <form method ="POST"> 
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="r_email" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
              <label for="inputEmail">Enter email address</label>
            </div>
          </div>
          <input type="submit"  class="btn btn-success btn-block" name="reset-pwd" value="Reset Password">
        </form>

        <div class="text-center">
          <a class="d-block small" href="index.php">Login Page</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
   <!--INject Sweet alert js-->
 <script src="vendor/js/swal.js"></script>

</body>

</html>
