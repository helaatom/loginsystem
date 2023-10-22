<?php session_start();
include_once('../includes/config.php');
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {
    // for deleting user
    if (isset($_GET['id'])) {
        $adminid = $_GET['id'];
        $msg = mysqli_query($con, "delete from task where id='$adminid'");
        if ($msg) {
            echo "<script>alert('Data deleted');</script>";
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
        <title>Manage Tasks | Registration and Login System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
            crossorigin="anonymous"></script>

    </head>

    <body class="sb-nav-fixed">
        <?php include_once('includes/navbar.php'); ?>
        <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Tasks</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Tasks</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Registered Tasks Details
                                <a href="add-task.php">Add Tasks</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Task Name</th>
                                            <th> Start Time</th>
                                            <th> End Time</th>
                                            <th> Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Task Name</th>
                                            <th> Start Time</th>
                                            <th> End Time</th>
                                            <th> Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        //   $id = $_SESSION['id'];
                                        $ret = mysqli_query($con, "select * from task");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) { ?>
                                            <tr>
                                                <td>
                                                    <?php echo $cnt; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['task_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['stime']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['ltime']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['notes']; ?>
                                                </td>
                                                <td>

                                                    <!-- <a href="edit-task.php?uid=<?php echo $row['id']; ?>"> 
                          <i class="fas fa-edit"></i></a> -->
                                                    <a href="#" class="csv-download"
                                                        data-taskname="<?php echo $row['task_name']; ?>" data-starttime="<?php echo $row['stime']; ?>" data-endtime="<?php echo $row['ltime']; ?>"
                                                        data-notes="<?php echo $row['notes']; ?>" data-description="<?php echo $row['description']; ?>"><i class="fa fa-download"
                                                            aria-hidden="true"></i></a>
                                                    <a href="manage-task.php?id=<?php echo $row['id']; ?>"
                                                        onClick="return confirm('Do you really want to delete');"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('../includes/footer.php'); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const csvDownloadLinks = document.querySelectorAll('.csv-download');
                csvDownloadLinks.forEach(function (link) {
                    link.addEventListener('click', function (event) {
                        event.preventDefault();
                        const taskName = this.getAttribute('data-taskname');
                        const starttime = this.getAttribute('data-starttime');
                        const endtime = this.getAttribute('data-endtime');
                        const notes = this.getAttribute('data-notes');
                        const description = this.getAttribute('data-description');
                        const csvData = `"Task Name","start Time","End Time","Note","Description"\n"${taskName}",${starttime}",${endtime}","${notes}","${description}"`;
                        const blob = new Blob([csvData], { type: 'text/csv' });
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'task_data.csv';
                        document.body.appendChild(a);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    });
                });
            });
        </script>
    </body>

    </html>
<?php } ?>