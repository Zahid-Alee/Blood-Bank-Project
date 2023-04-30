<!-- Navigation Bar -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="/assets/css/admin.css">
  <style>
    .main-container {

      display: flex;
    }

    .link-container {
      height: 70%;
      overflow-y: scroll;
    }

    .sidebar {
      /* position: fixed; */
      top: 6px;
      bottom: 0;
      left: 0;
      z-index: 100;
      padding: 48px 0 0;
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
      height: 100%;

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
    <div class="row">
      <?php require_once 'sidebar.php'; ?>
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
        <div class="container link-container">
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
      </main>
    </div>
  </div>

</body>

</html>

<!-- 
<!-- 
<!-- 
   
 <div class='card'>
<div class="card border-0 rounded-0 animate__animated animate__fadeIn">
  <div class="card-header bg-danger text-white">
    <h5 class="card-title mb-0"><i class="fas fa-tint"></i> Blood Donation Post</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-user"></i> Donor information</h6> 
      <p class="card-text"></p> 
         <p class="card-text"><i class="fas fa-user"></i> Full Name: John Doe</p> 
         <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-male"></i> Donor Age</h6> 
         <p class="card-text"></p> 
         <p class="card-text"><i class="fas fa-male"></i> Age: 27 years old</p>
      </div>
      <div class="col-md-6">
        <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-notes-medical"></i> Blood Details</h6>
        <p class="card-text"><i class="fas fa-tint"></i> Blood Type: AB+</p>
        <p class="card-text"><i class="fas fa-heartbeat"></i> Units Available: 2</p>
        <p class="card-text"><i class="fas fa-calendar-alt"></i> Date Posted: March 30, 2023</p>
        <p class="card-text"><i class="fas fa-map-marker-alt"></i> Location: New York City</p>
      </div>
    </div>
  </div>
  <div class="card-footer bg-white">
    <a href="#" class="btn btn-danger"><i class="fas fa-phone-alt"></i> Contact Donor</a>
    <i class="far fa-heart float-right"></i>
  </div>
</div>  

 </div>
<div class="container mt-5">
  <div class="card border-0 rounded-0 animate__animated animate__fadeIn">
    <div class="card-header bg-danger text-white">
      <h5 class="card-title mb-0"><i class="fas fa-tint"></i> Post Blood Donation</h5>
    </div>
    <div class="card-body">
      <form id="bloodDonationForm">
        <div class="form-group">
          <label for="donorName"><i class="fas fa-user"></i> Donor Name</label>
          <input type="text" class="form-control" id="donorName" name="donorName" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="donorAge"><i class="fas fa-male"></i> Donor Age</label>
          <input type="number" class="form-control" id="donorAge" name="donorAge" placeholder="Enter your age" required>
        </div>
        <div class="form-group">
          <label for="bloodType"><i class="fas fa-notes-medical"></i> Blood Type</label>
          <select class="form-control" id="bloodType" name="bloodType" required>
            <option value="" disabled selected>Select blood type</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>
        </div>
        <div class="form-group">
          <label for="unitsAvailable"><i class="fas fa-heartbeat"></i> Units Available</label>
          <input type="number" class="form-control" id="unitsAvailable" name="unitsAvailable" placeholder="Enter number of units available" required>
        </div>
        <div class="form-group">
          <label for="datePosted"><i class="fas fa-calendar-alt"></i> Date Posted</label>
          <input type="date" class="form-control" id="datePosted" name="datePosted" required>
        </div>
        <div class="form-group">
          <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
          <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
        </div>
        <button type="submit" class="btn btn-danger"><i class="fas fa-paper-plane"></i> Submit</button>
      </form>
    </div>
  </div>
</div> 

<script>
  const bloodDonationForm = document.getElementById("bloodDonationForm");
  bloodDonationForm.addEventListener("submit", submitBloodDonationForm);

  function submitBloodDonationForm(event) {
    event.preventDefault();
    const formValues = new FormData(event.target);
    const formJSON = Object.fromEntries(formValues.entries());
    console.log(formJSON);
    // Add code here to send the form data to the server using AJAX or fetch
  }
</script>


</div>

    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>
</div>
</main>
</div>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper-core.min.js"
    integrity="sha384-1l/xcjO+D8OORwzFVZwyAsE37zNId7S8oITP5VOWDGNb5vj5f7k4b4GYcZm2to+"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-Z7aPSc+bbdV7n5p5n4W4+e/OwKQZnmIlzxiDEhtKU7O6/tBQ2UJH+I0TKmK0Mfgm"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.31.0/dist/feather.min.js"
    integrity="sha384-yDXFMc1LRvNSA/FbWeIaLsQ21oKKzqpdBy1hdTgyzBlTdj6nG9r/UvU28DyIkBBi"
    crossorigin="anonymous"></script>
  <script>
    feather.replace()
  </script>-->