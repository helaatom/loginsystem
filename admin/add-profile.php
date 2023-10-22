<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['insert']))
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    // Assuming you have a database connection in $con
    $msg = mysqli_query($con, "INSERT INTO users (fname, lname, contactno, email, password) VALUES ('$fname', '$lname', '$contact', '$email', '$password')");

    if($msg)
    {
        echo "<script>alert('Profile added successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-users.php'; </script>";
    }
}



    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Add Task | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
<?php 
// $userid=$_GET['uid'];
// $query=mysqli_query($con,"select * from users where id='$userid'");
// while($result=mysqli_fetch_array($query))
// {?>
                         <h1 class="mt-4">Add Profile</h1>
                        <div class="card mb-4">
                     <form method="post">
                            <div class="card-body">
                                <table class="table table-bordered">
                                   <tr>
                                    <th>First Name</th>
                                       <td><input class="form-control" id="fname" name="fname" type="text" value="" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Last Name</th>
                                       <td><input class="form-control" id="lname" name="lname" type="text" value=""  required /></td>
                                   </tr>
                                         <tr>
                                       <th>Contact No.</th>
                                       <td colspan="3"><input class="form-control" id="contact" name="contact" type="text" value=""  pattern="[0-9]{10}" title="10 numeric characters only"  maxlength="10" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Email</th>
                                       <td colspan="3"><input class="form-control" id="email" name="email" type="email" value="" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Password</th>
                                       <td colspan="3"><input class="form-control" id="pass" name="pass" type="text" value="" readonly required /></td>
                                   </tr>
                                     
                                   <tr>
                                       <td colspan="4" style="text-align:center ;"><button type="submit" class="btn btn-primary btn-block" name="insert">Submit</button></td>

                                   </tr>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
<?php //} ?>

                    </div>
                </main>
          <?php include('../includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        function generateStrongPassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = "";

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset.charAt(randomIndex);
            }

            return password;
        }

        $(document).ready(function () {
            const generatedPassword = generateStrongPassword(12); // Change the length as needed
            $('#pass').val(generatedPassword);
        });
    </script>
    </body>
</html>
<?php } ?>
