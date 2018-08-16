<?php
	
	session_start();
	include_once('dbconnect.php');

	$error = false;

	if (isset($_POST['Login']))
	{
			$adminId = trim($_POST['adminId']);
			$adminId = htmlspecialchars(strip_tags($adminId));

			$password = trim($_POST['password']);
			$password = htmlspecialchars(strip_tags($password));

			if (empty($adminId)) 
			{
				$error = true;
				$erroradminId = 'Please enter a valid Admin Id.';
			}

			if (empty($password)) 
			{
				$error = true;
				$errorpassword = 'Please enter a valid Password';
			}


			if (!$error) 
			{
				$sql = "SELECT * FROM institution WHERE adminId='$adminId'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				$row = mysqli_fetch_assoc($result);

				if ($count == 1 && $row['password'] == $password) 
				{
					session_start();
					$_SESSION['adminId'] = $row['adminId'];
					header('location: index.php');
				}
				else
				{
					/*echo 'ERROR : '.mysqli_error($conn);*/
					$errormsg  = /*'ERROR : '.mysqli_error($conn)+*/'Invalid Admin Id or Password';
				}
			}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>signup</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="assets/js/jquery.min.js"></script>
</head>
<body>
	<!-- <div class="msg_box"></div> -->
	<div class="testbox">
		<h1>Admin Login</h1>
	<b   r>
	<!-- confrirmation -->
	<?php
		if (isset($errormsg))
		{
			?>
                <div class="alert alert-warning" style="margin-top: 0px; margin-bottom: 0px;">
                    <span class="glyphicon glyphicon-info-sign"><?php echo $errormsg; ?></span>
                </div>
                <?php
		}
	?>

		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" autocomplete="off">
	
		<!-- name box -->
			<label id="icon" for="name"><i class="icon-user"></i></label>
			<input type="text" name="adminId" id="name" placeholder="Name" required/>
			<!-- password -->
			<label id="icon" for="password"><i class="icon-shield"></i></label>
			<input type="password" name="password" id="password" placeholder="Password" required/>
	<br>
			<input type="submit" name="Login" value="Login" />
	<br>
		<p>Click here to <a href="Dashboard/Add new/schoolRegisteration.php">register</a> your school, if not registered.</p>
		<!-- <input type="submit" name="AddUserbtn" value="Login" onclick="checkField()" /> -->
		</form>
	</div>
</body>
</html>
<!-- <script type="text/javascript">
	function checkField()
	{
		//alert("hi");
		/*decalaring variables*/
		var name = $('#name').val();
		var email = $('#email').val();
		var password = $('#password').val();
		//alert(name);
		
		var filterName = /^[a-zA-Z ]*$/;

		var filterEmail  = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

		/*at least one number, one lowercase and one uppercase letter
    	  at least six characters*/
		var filterPassword = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;

		/*declaring msg.*/
		//alert("hi");
		var msg = "";

		if (!filterName.test(name) || name.length<3)
		{
			msg = "Please enter a valid name.";
		}
		//alert(filterEmail.test(email));
		else if (!filterEmail.test(email))
		{
			//alert("enter valid email");
			msg = "Please enter a valid Email.(eg:kiko@gmail.com)";
		}
		else if(!password.match(filterPassword))
		{
			//alert("enter valid password");
			msg = "Please enter a valid Password.(at least one number, one lowercase and one uppercase letter at least six characters).";
		}
	
		if(msg != "")
		{
			$('.msg_box').html(msg).show().delay(2000).fadeOut('slow');
		}
		

	}
</script> -->

