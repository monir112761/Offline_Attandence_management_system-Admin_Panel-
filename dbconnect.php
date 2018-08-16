<?php
  $servername = 'localhost';
  $username = 'root'; 
  $password = '';
  $dbname = 'student_attendence_management_systems';

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(!$conn)
  {
    echo "Connection Error!".mysqli_connect_error();
  }


 ?>
