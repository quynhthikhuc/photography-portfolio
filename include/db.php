<?php
  define('DB_SERVER', '162.241.24.62');
  define('DB_USER', 'quynhthi_khuc');
  define('DB_PASS', '4Y?H2cv}jvGH');
  define('DB_NAME', 'quynhthi_photography-portfolio');

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  // Test if connection succeeded
  if (mysqli_connect_errno()) {
    die ('Database connection failed: ' .
        mysqli_connect_error() .
        ' )' . mysqli_connect_errno() . ')'
    );
  }
?>