<!-- Navigation Bar -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/assets/css/admin.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .main-container {

      display: flex;
    }

    .link-container {
      height: 70%;
      overflow-y: scroll;
    }


    a:hover {
      color: rgb(186, 184, 184);
    }

    table {
      background-color: #fff;
      border: 1px solid #ddd;
      font-family: 'Open Sans', sans-serif;
      font-size: 14px;
    }

    thead th {
      background-color: #941818 !important;
      color: #fff;
    }

    .table-icon {
      margin-right: 5px;
    }

    .table-icon i {
      color: #dc3545;
    }

    tbody tr:nth-of-type(odd) {
      background-color: #f8f9fa;
    }

    .action-icons {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .action-icons a {
      margin-right: 5px;
    }



    
  </style>
</head>

<body>
  <?php require_once './components/navbar.php'; ?>

  <div class="container-fluid">
    <!-- <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Dashboard</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Share</button>
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>
        
      </main>
    </div> -->
  </div>

  <div class="sidebar close">
      <?php require_once 'sidebar.php'; ?>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu'></i>
            <span class="text">Drop Down Sidebar</span>

          
            
        </div>
        <div class='dashboard-content px-5' >
          <?php
          $link = isset($_GET['link']) ? $_GET['link'] : 'dashboard';
          if ($link == 'dashboard') {
            require_once 'dashboard.php';
          } elseif ($link == 'bloodStock') {
            require_once 'bloodStock.php';
          } elseif ($link == 'donationRequest') {
            require_once 'donationRequest.php';
          } elseif ($link == 'donationForm') {
            require_once './components/donationForm.php';
          } elseif ($link == 'bloodRequest') {
            require_once 'bloodRequest.php';
          }

          ?>
          </div>
    </section>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
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
