<?php

    include_once('../../../dbconnect.php');

    $error = false;

   
    if (isset($_POST['Register']))
    {
        /*prevents sql injections*/
        $institutionName = $_POST['institutionName'];
        $institutionName = strip_tags($institutionName);
        $institutionName = htmlspecialchars($institutionName);

        $institutionId = $_POST['institutionId'];
        $institutionId = strip_tags($institutionId);
        $institutionId = htmlspecialchars($institutionId);

        $institutionType = $_POST['institutionType'];
        $institutionType = strip_tags($institutionType);
        $institutionType = htmlspecialchars($institutionType);

        $principalName = $_POST['principalName'];
        $principalName = strip_tags($principalName);
        $principalName = htmlspecialchars($principalName);

        $institutionPhoneNo = $_POST['institutionPhoneNo'];
        $institutionPhoneNo = strip_tags($institutionPhoneNo);
        $institutionPhoneNo = htmlspecialchars($institutionPhoneNo);

        $institutionEmail = $_POST['institutionEmail'];
        $institutionEmail = strip_tags($institutionEmail);
        $institutionEmail = htmlspecialchars($institutionEmail);

        $institutionAddress = $_POST['institutionAddress'];
        $institutionAddress = strip_tags($institutionAddress);
        $institutionAddress = htmlspecialchars($institutionAddress);

        $adminId = $_POST['adminId'];
        $adminId = strip_tags($adminId);
        $adminId = htmlspecialchars($adminId);

        $password = $_POST['password'];
        $password = strip_tags($password);
        $password = htmlspecialchars($password);
    }

    if (empty($institutionId))
    {
        $error = true;
    }

    if (empty($institutionName)) 
    {
        $error = true;
    }

    if (empty($institutionType)) 
    {
        $error = true;
    }

    if (empty($principalName)) 
    {
        $error = true;
    }

    if (empty($institutionPhoneNo) || strlen($institutionPhoneNo) != 10) 
    {
        $error = true;
    }

    if (empty($institutionEmail))
    {
        $error = true;
    }

    if (empty($institutionAddress))
    {
        $error = true;
    }

    if (empty($adminId)) 
    {
        $error = true;
    }

    if (empty($password)) 
    {
        $error = true;
    }



    if (!$error)
    {       
        /*echo "<script>
    alert('Fine has been paid by the borrower.')
    window.location.href='BorrowOverdue.php';
    </script>
    ";*/

        $sql = "INSERT INTO institution(institutionId, institutionName, institutionType, principalName, institutionPhoneNo, institutionEmail, institutionAddress, adminId, password) VALUES ('$institutionId','$institutionName','$institutionType','$principalName','$institutionPhoneNo','$institutionEmail','$institutionAddress','$adminId','$password')";
    
            if(mysqli_query($conn, $sql))
            {
                $successmez = 'Your School is successfully registered. Press here to Login';
            }
            else
            {
                /*echo 'Error'.mysqli_error($conn);*/
                $notice = /*'Check'.mysqli_error($conn)+*/' Your data was entered. Press here to Log in';
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
                    <h1>Student Attendence Management System</h1>
                </a>
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->


                <div class="span9" style="margin-top: 50px; margin-left: 200px;">
                    <div class="content">

                        <div class="module" >
                            <div class="module-head">
                                <h3 style="text-align: center;">Registeration form</h3>
                            </div>
                            <div class="module-body">

                                                                <?php
                                        if(isset($successmez))
                                        {
                                          ?>
                                          <div class="alert alert-success">
                                            <span class="glyphicon glyphicon-info-sign"><a href="../../signin.php"><?php echo $successmez; ?><a/></span>
                                          </div>
                                          <?php
                                        }
                                        else if (isset($notice))
                                        {
                                        ?>
                                            <div class="alert alert-success">
                                            <span class="glyphicon glyphicon-info-sign"><a href="../../../signin.php"><?php echo $notice; ?><a/></span>
                                          </div>
                                          <?php
                                        }
                                       ?>

                                    <br />

                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal row-fluid" >

                                        <div class="control-group">
                                            <label class="control-label" for="instuName">Name of your institution</label>
                                            <div class="controls">
                                                <input type="text" id="instuName" name="institutionName" placeholder="eg: Don Bosco" class="span8"><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkinstuName"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="instuID">Institution Id</label>
                                            <div class="controls">
                                                <input type="text" id="instuID" name="institutionId" placeholder="eg: D-B" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkinstuID"></span>
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label">Type of your Institution</label>
                                            <div class="controls">
                                                <label class="radio inline">
                                                    <input type="radio" name="institutionType" id="optionsRadios1" value="Upper Primary" checked="">
                                                    Option one
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="institutionType" id="optionsRadios2" value="Lower Primary">
                                                    Option two
                                                </label> 
                                                <label class="radio inline">
                                                    <input type="radio" name="institutionType" id="optionsRadios3" value="Higher Secondary">
                                                    Option three
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="principal">Name of your Principal</label>
                                            <div class="controls">
                                                <input type="text" id="principal" name="principalName" placeholder="Principal Name" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkprincipal"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="phone_number">Phone number</label>
                                            <div class="controls">
                                                <input type="number" id="phone_number"
                                                name="institutionPhoneNo" placeholder="Phone number" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkphone_number"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="email">Email</label>
                                            <div class="controls">
                                                <input type="text"
                                                name="institutionEmail" id="email" placeholder="kiko8797@gmail.com" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkemail"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="address">Address</label>
                                            <div class="controls">
                                                <textarea id="address" name="institutionAddress" class="span8" rows="5" required></textarea><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkaddress"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="adminID">AdminId</label>
                                            <div class="controls">
                                                <input type="text" id="adminID" name="adminId" placeholder="first 3 letters of your name" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkadminID"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="password">Password</label>
                                            <div class="controls">
                                                <input type="text" id="password"
                                                name="password" placeholder="Should contain uppercase, lowercase, atleast one number and a symbol" class="span8" required><br><br>
                                                <span class="alert alert-error" style="display: none;" id="checkpassword"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button name="Register" type="submit" class="btn btn-primary btn-xl" onclick="checkFields()">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!--/.content-->
                    </div><!--/.span9-->
</body>

<script type="text/javascript">
    function checkFields()
    {
        /*declaring variables*/

        var instuName = $('#instuName').val();
        var instuID = $('#instuID').val(); 
        var principal = $('#principal').val();
        var phone_number = $('#phone_number').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var adminID = $('#adminID').val();
        var password = $('#password').val();

        var filterName = /^[a-zA-Z ]*$/;
        var filterEmail  = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        var filterPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        var filterIds = /[A-Z]/;

        var error = false;

        if (!filterName.test(instuName) || instuName.length<6)
        {
            error = true;
           $('#checkinstuName').html("Institution name is not valid").show().delay(1000).fadeOut('slow');
        }
        /*else if (!filterIds.test(instuID))
        {
            $('#checkinstuID').html(instuID + " is not valid").show().delay(3000).fadeOut('slow');
        }*/
        
        if (!filterName.test(principal) || principal.length<6)
        {
            error = true;
            $('#checkprincipal').html("Principal name is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if (phone_number.length!=10 || isNaN(phone_number))
        {
            error = true;
            $('#checkphone_number').html("Phone number is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if (!filterEmail.test(email))
        {
            error = true;
            $('#checkemail').html("email is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if (address.value.length == 0)
        {
            error = true;
            $('#checkaddress').html("address is not valid").show().delay(1000).fadeOut('slow');
        }
        
        if(!filterPassword.test(password))
        {
            error = true;
            $('#checkpassword').html("password is not valid").show().delay(1000).fadeOut('slow');
        }

        if(!filterIds.test(adminID))
        {
            error = true;
            $('#checkadminID').html("Admin Id is not valid").show().delay(1000).fadeOut('slow');
        }
    }

    $(document).ready(function()
    {
        $('.span8').keyup(function(){
        checkFields();1000
        });
    });


</script>