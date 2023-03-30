<?php

// use Phppot\user;
require_once __DIR__ . '/middleware/auth.php';
$checkAuth = new authMiddleware\AuthMiddleware;
$username = null;

if (!$checkAuth->checkAuth()) {
    exit; // stop executing the rest of the page
} else {
// session_start();
    $username = $_SESSION["username"];
    session_cache_limiter('nocache');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Bank Management System</title>
<body>
<?php 
  echo require_once('./components/admin/adminPanel.php');
  ?>


</body>
</html> 