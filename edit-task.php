<?php session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
//Code for Updation 
if(isset($_POST['update']))
{
    $task_name = $_POST['task_name'];
    $stime = $_POST['stime'];
    $ltime = $_POST['ltime'];
    $notes = $_POST['notes'];
    $description = $_POST['description'];
    // $userid=$_SESSION['id'];
    $task_id=$_GET['uid'];
    // Assuming you have a database connection in $con
    $msg=mysqli_query($con,"update task set task_name='$task_name',stime='$stime',ltime='$ltime',notes='$notes',description='$description' where id='$task_id'");
    if($msg)
    {
        echo "<script>alert('Task Update successfully');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-task.php'; </script>";
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
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">


    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        
<?php 
$userid=$_GET['uid'];
$query=mysqli_query($con,"select * from task where id='$userid'");
while($result=mysqli_fetch_array($query))
{?>
                         <h1 class="mt-4">Add Task</h1>
                        <div class="card mb-4">
                     <form method="post">
                            <div class="card-body">
                                <table class="table table-bordered">
                                   <tr>
                                    <th>Task Name</th>
                                       <td><input class="form-control" id="task_name" name="task_name" type="text" value="<?php echo $result['task_name'];?>" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Start Time</th>
                                       <td><input class="form-control" id="stime" name="stime" type="text" value="<?php echo $result['stime'];?>"  required /></td>
                                   </tr>
                                         <tr>
                                       <th>Stop Time</th>
                                       <td colspan="3"><input class="form-control" id="ltime" name="ltime" type="text" value="<?php echo $result['ltime'];?>" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Notes</th>
                                       <td colspan="3"><input class="form-control" id="notes" name="notes" type="text" value="<?php echo $result['notes'];?>"  /></td>
                                   </tr>
                                   <tr>
                                       <th>Description</th>
                                       <td colspan="3"><textarea class="form-control" id="description" name="description" ><?php echo $result['description'];?></textarea>
                                   </tr>
                                     
                                   <tr>
                                       <td colspan="4" style="text-align:center ;"><button type="submit" class="btn btn-primary btn-block" name="update">Update</button></td>

                                   </tr>
                                    </tbody>
                                </table>
                            </div>
                            </form>
                        </div>
<?php } ?>

                    </div>
                </main>
          <?php include('includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
        <script>
$(document).ready(function() {
    // Initialize the date-time picker for Start Time
    $("#stime").datetimepicker();

    // Initialize the date-time picker for Stop Time
    $("#ltime").datetimepicker();
});
</script>



    </body>
</html>
<?php } ?>
