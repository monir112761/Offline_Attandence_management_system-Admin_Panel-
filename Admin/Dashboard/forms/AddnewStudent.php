<?php

    session_start();
    if (!isset($_SESSION['adminId'])) 
    {
        header("location: ../../../signin.php");
    }
    else
    {

        include_once('../../../dbconnect.php');

        $error = false;
       
        if (isset($_POST['submit']))
        {
            /*prevents sql injections*/
            /*$token = md5(uniqid(rand(), TRUE));
            $SESSION['token'] = $token;
            $SESSION['token_time'] = time();*/

            $studentName = $_POST['studentName'];
            $studentName = strip_tags($studentName);
            $studentName = htmlspecialchars($studentName);

            $studentClass = $_POST['studentClass'];
            $studentClass = strip_tags($studentClass);
            $studentClass = htmlspecialchars($studentClass);

            $studentPhoneNo = $_POST['studentPhoneNo'];
            $studentPhoneNo = strip_tags($studentPhoneNo);
            $studentPhoneNo = htmlspecialchars($studentPhoneNo);

            $studentAddress = $_POST['studentAddress'];
            $studentAddress = strip_tags($studentAddress);
            $studentAddress = htmlspecialchars($studentAddress);

        }

        if (empty($studentName)) 
        {
            $error = true;
        }
        if (empty($studentClass)) 
        {
            $error = true;
        }

        if (empty($studentPhoneNo))
        {
            $error = true;
        }

        if (empty($studentAddress)) 
        {
            $error = true;
        }



        if (!$error)
        {   
            $sql = "INSERT INTO `student`(`studentName`, `studentClass`, `studentPhoneNo`, `studentAddress`) VALUES ('$studentName','$studentClass','$studentPhoneNo','$studentAddress')";
        
                if(mysqli_query($conn, $sql))
                {
                    $successmez = 'New Student is successfully Added. Insert details to insert more.';
                }
                else
                {
                    /*echo 'Error'.mysqli_error($conn);*/
                    $notice = ' Enter new Details. This Id already exists';          
                }

        }



?>
<!DOCTYPE html>
<html lang="en">


<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registeration Form</title>
        <link type="text/css" href="../../../assets/DashboardAssets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/css/theme.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/css/button.css" rel="stylesheet">
        <link type="text/css" href="../../../assets/DashboardAssets/images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
        <script src="../../../assets/js/jquery.min.js"></script>
        <script src="../../../assets/DashboardAssets/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="../../../assets/DashboardAssets/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="../../../assets/DashboardAssets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../assets/DashboardAssets/scripts/flot/jquery.flot.js" type="text/javascript"></script>
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
                                <a href="../index.php">
                                    <i class="menu-icon icon-dashboard"></i>
                                    Dashboard
                                </a>
                            </li>
                        
                        </ul><!--/.widget-nav-->

                        <ul class="widget widget-menu unstyled">
                                <li><a href="AddnewTeacher.php"><i class="menu-icon icon-tasks"></i>Add new Teacher </a>
                                <li><a href="AddnewStudent.php"><i class="menu-icon icon-tasks"></i>Add new Student </a>
                                <li><a href="AddnewSubject.php"><i class="menu-icon icon-tasks"></i>Add new Subject </a>   
                                <li><a href="AddnewClass.php"><i class="menu-icon icon-tasks"></i>Add new Class </a> 
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
                            <div class="module-head">
                                <h3 style="text-align: center;">Add new Student</h3>
                            </div>
                            <div class="module-body">

                                    <br />

                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal row-fluid">

                                        <?php
                                        if(isset($successmez))
                                        {
                                          ?>
                                          <div class="alert alert-success">
                                            <span class="glyphicon glyphicon-info-sign"><?php echo $successmez; ?></span>
                                          </div>
                                          <?php
                                        }
                                        else if (isset($notice))
                                        {
                                        ?>
                                            <div class="alert alert-success">
                                            <span class="glyphicon glyphicon-info-sign"><?php echo $notice; ?></span>
                                          </div>
                                          <?php
                                        }
                                       ?>

                                    <br />
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="studentName">Name</label>
                                            <div class="controls">
                                                <input type="text" id="studentName"
                                                name="studentName" placeholder="Student Name" class="span8"><br><br>
                                                <span class="alert alert-error" id="checkstudentName" style="display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="class_section">class-section</label>
                                            <div class="controls">
                                                <input type="text" id="class_section"
                                                name="  studentClass" placeholder="eg: 2-A" class="span8"><br><br>
                                                <span class="alert alert-error" id="checkclass_section" style="display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone_number">Phone Number(Parent)</label>
                                            <div class="controls">
                                                <input type="number" id="phone_number"
                                                name="studentPhoneNo" placeholder="phone number" class="span8"><br><br>
                                                <span class="alert alert-error" id="checkphone_number" style="display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="address">Address</label>
                                            <div class="controls">
                                                <textarea class="span8" rows="5" id="address"
                                                name="studentAddress"></textarea><br><br>
                                                <span class="alert alert-error" id="checkaddress" style="display: none;"></span>
                                            </div>
                                        </div>



                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn btn-primary btn-xl">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                            </div>
                        </div>

                        
                        
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->
</body>
</html>
<script type="text/javascript">
    function checkFields()
    {
        /*declaring variables*/

        var studentName = $('#studentName').val();
        var class_section = $('#class_section').val();
        var phone_number = $('#phone_number').val();
        var address = $('#address').val();

        var filterName = /^[a-zA-Z ]*$/;
        var filterclassSection = /([0-9])-([A-Z])/
        var filterEmail  = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var filterIds = /^[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}$/;

        

        if (!filterName.test(studentName) || studentName.length<6)
        {
           $('#checkstudentName').html("Student name is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if (!filterclassSection.test(class_section))
        {
            $('#checkclass_section').html("Class section format is not valid").show().delay(1000).fadeOut('slow');
        }
        if (phone_number.length!=10)
        {
            $('#checkphone_number').html("Phone number is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if (address.value.length == 0)
        {
            $('#checkaddress').html("address is not valid").show().delay(1000).fadeOut('slow');
        }
        
        
    }

    $(document).ready(function()
    {
        $('.span8').keyup(function(){
        checkFields();
        });
    });

</script>

<?php
}
?>