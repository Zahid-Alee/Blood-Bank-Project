<style>
  .navbar {

    width: 100%;
    background-color: #141934;
    color: whitesmoke;
  }

  .navbar-brand {
    font-size: 1.5rem;
  }

  .navbar-nav .nav-link {
    /* font-size: 1.1rem; */
    margin-left: 1rem;
    margin-right: 1rem;
    color: whitesmoke !important;
  }

  .nav-item a {
    color: rgb(0 0 0 / 73%) !important;
  }

  .nav-item a:hover {

    color: #bfb8b8 !important;
  }

  .navbar-toggler {
    border: none;
  }

  @media (max-width: 768px) {
    .navbar-nav {
      flex-direction: column;
      text-align: center;
    }

    .navbar-nav .nav-link {
      margin-top: 1rem;
      margin-bottom: 1rem;
    }
  }
</style>
<?php session_start();
$username = $_SESSION['username'];
$id = $_SESSION['userID'];
use DataSource\DataSource;

require_once __DIR__ . '../../../lib/DataSource.php';

$con = new DataSource;
// Retrieve the cake details based on the CakeID

$query = "SELECT * FROM user_notifications WHERE userID = ?";
$paramType = "i";
$paramValue = array($id);
$notifications = $con->select($query, $paramType, $paramValue);

if (!empty($notifications)) {
  $notCount = count($notifications);
} else {
  $notCount = 0;
}


?>
<nav id="navigation" class="navbar navbar-expand-lg navbar-light" style="backgroud:transparent">
  <a class="navbar-brand" href="#"><img src="BBM/Module/users/images/blood.png" alt=""></a>
  <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/BBM"><i class="fas fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link about-us-link" href="Modules/users/about.php"><i class="fas fa-info-circle"></i> About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/BBM/Modules/users/notification.php"><i class="fas fa-envelope"></i> Notifications <sup class='text-danger'> <strong><?php echo $notCount ?></strong></sup></a>
      </li>
      <li class="nav-item">
        <a class="nav-link contact-us-link" href="#contact"><i class="fas fa-bell"></i> Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i>
          <?php echo $username ?>
        </a>
      </li>
    </ul>
  </div>
</nav>

<script>
  const navbarToggler = document.querySelector('.navbar-toggler');
  const navbarCollapse = document.querySelector('.navbar-collapse');

  navbarToggler.addEventListener('click', () => {
    navbarCollapse.classList.toggle('show');
  });

  // Hide search options dropdown when clicked outside of it


</script>