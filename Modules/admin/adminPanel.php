<!-- Navigation Bar -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Modules/admin/admin.css">
  <link rel="stylesheet" href="Modules/admin/sidebar.css">
  <link rel="stylesheet" href="Modules/admin/footer.css">


  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

  </style>
</head>

<body>

  <div class="container-fluid">

  </div>


  <div class="sidebar close">
    <?php include 'sidebar.php'; ?>
  </div>
  <section class="home-section">
    <div class="home-content" style=" font-size:35px">
      <div>
        <i class='bx bx-menu' style="color:#c41818;"></i>
        <strong> Blood Bank Management
        </strong>
      </div>
      <strong class="text-capitalize px-3" style="color:#c41818; font-size:16px ;">
        <?php echo $_SESSION['username'] ?>
        <a href="logout.php" class='text-dark'><i class='bx bx-log-out px-3'></i></a>

        </span>
    </div>
    <div class='dashboard-content px-2'>
      <?php
      $link = isset($_GET['link']) ? $_GET['link'] : 'dashboard';
      if ($link == 'dashboard') {
        include 'dashboard.php';
      } elseif ($link == 'bloodStock') {
        include 'bloodStock.php';
      } elseif ($link == 'donationRequest') {
        include 'donationRequest.php';
      } elseif ($link == 'donationForm') {
        include './components/donationForm.php';
      } elseif ($link == 'bloodRequest') {
        include 'bloodRequest.php';
      } elseif ($link == 'donationsHistory') {
        include 'checkHistory.php';
      } elseif ($link == 'donorHealth') {
        include 'donorHealth.php';
      } elseif ($link == 'userFeedback') {
        include 'feedback.php';
      }
      ?>
    </div>
    <div id="preloader">
      <div id="loader"></div>
    </div>

  </section>
  <script>
    window.addEventListener('load', function() {
      var preloader = document.getElementById('preloader');
      preloader.style.display = 'none';
    });

    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    });
  </script>


</body>

</html>