<?php

// use DataSource\user;
require_once __DIR__ . '/middleware/auth.php';
$checkAuth = new authMiddleware\AuthMiddleware;
$username = null;

if (!$checkAuth->checkAuth()) {

  header('Location:login.php');
  exit; // stop executing the rest of the page
} else {
  // session_start();
  $username = $_SESSION["username"];
  session_cache_limiter('nocache');
}

?>
<!DOCTYPE html>
<html lang="en">

<head?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Bank Management System</title>
  <link rel="stylesheet" href="/assets/css/admin.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
  <?php
  echo require_once('./Modules/users/userPanel.php');
  ?>


</body>

</html>