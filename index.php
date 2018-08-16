<?php

    session_start();
    if (!isset($_SESSION['adminId'])) 
    {
        header("location: signin.php");
    }
    else
    {
        include_once('dbconnect.php');

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link type="text/css" href="assets/DashboardAssets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="assets/DashboardAssets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="assets/DashboardAssets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="assets/DashboardAssets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <script src="assets/DashboardAssets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="assets/DashboardAssets/scripts/common.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container"><a class="brand" href="index.html">Student Attendence Management System </a>
                    <div class="">
                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>
                        <ul class="nav pull-right">
                            <li><a href="#"><?php echo $_SESSION['adminId']; ?></a></li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                            </ul>

                            <!-- add new forms -->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="Admin/Dashboard/forms/AddnewTeacher.php"><i class="menu-icon icon-tasks"></i>Add new Teacher </a>
                                <li><a href="Admin/Dashboard/forms/AddnewStudent.php"><i class="menu-icon icon-tasks"></i>Add new Student </a>
                                <li><a href="Admin/Dashboard/forms/AddnewSubject.php"><i class="menu-icon icon-tasks"></i>Add new Subject </a>   
                                <li><a href="Admin/Dashboard/forms/AddnewClass.php"><i class="menu-icon icon-tasks"></i>Add new Class </a> 
                            </li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="Admin/Dashboard/Tables/listTeacherDetails.php" class="btn-box big span4"><i class=" icon-group"></i>
                                        <p class="text-muted">
                                            List of Teachers</p>
                                    </a><a href="Admin/Dashboard/Tables/listStudentDetails.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            List of Students</p>
                                    </a><a href="Admin/Dashboard/Tables/listSubjectDetails.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            List of Subjects</p>
                                    </a><a href="Admin/Dashboard/Tables/listClassDetails.php" class="btn-box big span4"><i 
                                    class="icon-group"></i>
                                        <p class="text-muted">
                                            List of Classes</p>
                                    </a><a href="Admin/Dashboard/attendenceSheet.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            check Attencence Sheet</p>
                                    </a>
                                    <a href="Admin/Dashboard/teacher_subject_class/teacher_subject_class.php" class="btn-box big span4"><i class="icon-group"></i>
                                        <p class="text-muted">
                                            Assign Class To Teacher</p>
                                    </a>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                    <div class="form-group" style="display: block;">
                                        <label for="csvfile" class="control-label col-xs-2"><b>Click "Choose File" to upload the List of students</b></label>
                                    <div class="col-xs-3">
                                        <input type="file" class="form-control" name="csv" id="csv">
                                        <button type="submit" name="upload" class="btn btn-primary">Upload</button>
                                    </div>
                                        <?php

                                            if (isset($_POST['upload'])) 
                                              {
                                                $file = $_FILES['csv'];
                                                  $file_name = basename($_FILES['csv']['name']);  
                                                  /*echo "File Name: ".$file_name;*/
                                                  if (move_uploaded_file($_FILES["csv"]["tmp_name"], $file_name)) {
                                                        /*echo "The file ".$file_name. " has been uploaded.";*/
                                                    } else {
                                                        echo "Sorry, there was an error uploading your file.";
                                                    }
                                                  $target_dir = "/";

                                                    /*$file = $file_name;*/
                                                    

                                                  $sqlDelete = "TRUNCATE TABLE `attendance`";
                                                  mysqli_query($conn,$sqlDelete);
                                                  $file = fopen($file_name, "r");
                                                  while (($emapData = fgetcsv($file, 11000, ",")) !== FALSE)
                                                    {

                                                        
                                                        /*if(mysqli_query($conn,$sqlDelete))*/
                                                        
                                                            $sql = "INSERT into attendance(E_id, Date_, _time) values('$emapData[0]','$emapData[1]','$emapData[2]')";
                                                            mysqli_query($conn,$sql);
                                                            /*{
                                                                echo "success";
                                                            }
                                                            else
                                                            {
                                                                echo "error : ".mysqli_error($conn);
                                                            }*/
                                                       /* }
                                                        else
                                                        {
                                                            echo "error : ".mysqli_error($conn);
                                                        }*/
                                                    }
                                                    fclose($file);
                                                    echo "CSV File has been successfully Imported.";
                                                }

                                        ?>
                                    </div>
                                </form>
        
      
    </body>
</html>
<?php } ?>