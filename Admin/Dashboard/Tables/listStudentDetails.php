<?php
    session_start();
    if(!isset($_SESSION['adminId']))
    {
      header("location: ../../../signin.php");
    }
    else
    {
      include_once('../../../dbconnect.php');

      /*if (isset($_POST['upload'])) 
      {
          $file = $_POST['csv'];
          $table= 'details';

          mysqli_query($conn, 'LOAD DATA LOCAL INFILE "'.$file.'"INTO TABLE "'.$table.'" FIELDS TERMINATED by \',\'LINES TERMINATED BY \'\n\'');
          
      }*/

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendence Management System</title>
    <link type="text/css" href="../../../assets/DashboardAssets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/css/button.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <script src="../../../assets/DashboardAssets/scripts/jquery-1.9.1.min.js"></script>
        <script src="../../../assets/DashboardAssets/scripts/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="../../../assets/DashboardAssets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../../assets/DashboardAssets/scripts/datatables/jquery.dataTables.js"></script>
</head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">

                <a class="brand" href="index.html">
                    Student Attendence Management System
                </a>

                <div class="">

                    <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                    </form>
                
                    <ul class="nav pull-right">
                        
                        
                        <li><a href="#">
                            <?php echo $_SESSION['adminId']; ?>
                        </a></li>
                        
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->



    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">

                        <ul class="widget widget-menu unstyled">
                            <li class="active">
                                <a href="../../../index.php">
                                    <i class="menu-icon icon-dashboard"></i>
                                    Dashboard
                                </a>
                            </li>
                        
                        </ul><!--/.widget-nav-->

                        <ul class="widget widget-menu unstyled">
                                <li><a href="../forms/AddnewTeacher.php"><i class="menu-icon icon-tasks"></i>Add new Teacher </a>
                                <li><a href="../forms/AddnewStudent.php"><i class="menu-icon icon-tasks"></i>Add new Student </a>
                                <li><a href="../forms/AddnewSubject.php"><i class="menu-icon icon-tasks"></i>Add new Subject </a>   
                                <li><a href="../forms/AddnewClass.php"><i class="menu-icon icon-tasks"></i>Add new Class </a> 
                                </li>
                            </ul><!--/.widget-nav-->

                        <ul class="widget widget-menu unstyled">
                            
                            
                            <li>
                                <a href="../../../logout.php">
                                    <i class="menu-icon icon-signout"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>

                    </div><!--/.sidebar-->
                </div><!--/.span3-->


                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <!-- to import the csv file -->
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="csvfile" class="control-label col-xs-2"><b>Enter the class for which csv will be created.</b></label>
                                <div class="col-xs-3">
                                    <input type="text" placeholder="classSection" class="form-control" name="ClassSection" id="ClassSection">
                                    <button type="submit" name="Export" class="btn btn-primary">Create CSV</button>
                                </div>
                                    <?php

                                        /*where query*/
                                        $where = "WHERE studentClass = 'ClassSection'";

                                        $csv_fileName = 'classSection'.'_Class'.'csv';

                                        /*create empty variable to be filled with export data*/
                                        $csv_export = '';

                                        /*query to get data from database*/
                                        $csvExportQuery = mysqli_query("SELECT studentRollNo, studentName, studentClass
                                                          FROM student ".$where);

                                        $field = mysql_num_fields($csvExportQuery);

                                        /*create line with field names*/
                                        for ($i=0; $i < $field; $i++) { 
                                          $csv_export.= mysql_field_name($query,$i).';';
                                        }

                                        /*newLine (seems to work both on linux and windows server)*/
                                        $csv_export.= '
                                        ';

                                        /*loop through databse query and fill export variable*/
                                        while ($row = mysql_fetch_array($csvExportQuery)) {
                                          /*create line with field values*/
                                          for ($i=0; $i < $field; $i++) { 
                                            $csv_export.='"'.$row[mysql_field_name($csvExportQuery, $i)].'";';
                                          }
                                          $csv_export.='
                                          ';
                                        }

                                        header("Content-Type: text/x-csv");
                                        header("Content-Disposition: att")



                                    ?>
                                </div>
                            </form>
                            <div class="module-head">
                                <h3>DataTables</h3>
                            </div>
                            <div class="module-body table">
                                <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Student Roll no</th>
                                            <th>Name</th>
                                            <th>CLass-section</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <!-- <th>Edit Details</th> -->
                                        </tr>
                                    </thead>
                                    <?php
                                      $sql = "SELECT * FROM `student` ORDER BY `studentRollNo` ASC";
                                      /*$sql1 = "SELECT `subject`.`subjectName` FROM `subject`,`teacher`,`subject_teacher` 
                                              WHERE `teacher`.`teacherId`=`subject_teacher`.`teacherId` AND 
                                              `subject`.`subjectId` = `subject_teacher`.`subjectId`";*/
                                      $query = mysqli_query($conn,$sql);
                                      if (mysqli_num_rows($query)>0) 
                                      {
                                        while ($row = mysqli_fetch_object($query)) 
                                        {
                                    ?>
                                        <tbody>
                                          <tr class="odd gradeX">
                                              <td><?php echo $row->studentRollNo ?></td>
                                              <td><?php echo $row->studentName ?></td>
                                              <td><?php echo $row->studentClass ?></td>
                                              <td><?php echo $row->studentPhoneNo ?></td>
                                              <td><?php echo $row->studentAddress ?></td>
                                              <!-- <td class="center"><a href="../editDetails/editStudentDetails.php?edit=1&studentRollNo=<?php echo $row->studentRollNo; ?>"><h4 style="color: #3a57af;">EDIT</h4></a></td> -->
                                          </tr>  
                                        </tbody>
                                    <?php    
                                        }
                                      }
                                    ?>
                                    <tfoot>
                                        <tr>
                                            <th>Student Roll no</th>
                                            <th>Name</th>
                                            <th>CLass-section</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <!-- <th>Edit Details</th> -->
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!--/.module-->

                    <br />
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->

    <script>
        $(document).ready(function() {
            $('.datatable-1').dataTable();
            $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        } );
    </script>
</body>
</html>
<?php } ?>