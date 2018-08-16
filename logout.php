<?php

  session_start();
  unset($_SESSION['adminId']);
  session_destroy();
  header("location: signin.php");

 ?>
