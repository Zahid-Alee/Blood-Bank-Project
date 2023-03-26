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

<HTML>

<HEAD>
    <TITLE>Welcome</TITLE>
    <link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
    <div class="phppot-container">
        <div class="page-header">
            
        <span class="login-signup"><a href="logout.php">Logout</a></span>
                                                   
        <div class="page-content">Welcome <?php echo $username; ?></div>
    </div>
</BODY>

</HTML>