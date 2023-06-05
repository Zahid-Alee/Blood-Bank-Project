<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Blood Bank Management System</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .container {
      margin-top: 80px;
    }

    css Copy code .svg-img {
      width: 100%;
      max-width: 400px;
      height: auto;
    }
  </style>
</head>

<body>
  <?php include './navbar.php' ?>
  <section class="about-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h2>About Our Blood Bank Management System</h2>
          <p>Our blood bank management system is designed to streamline the process of blood donation and blood
            requests. It provides a user-friendly interface for both donors and recipients to easily interact with the
            system.</p>

          <h4>Services:</h4>
          <ul>
            <li>User can donate blood: Individuals can create an account and register as blood donors, providing their
              personal information and blood type.</li>
            <li>User can request blood: Patients or hospitals in need of blood can submit blood requests specifying the
              blood type and quantity required.</li>
            <li>Create account: Users can create accounts to access additional features and functionalities.</li>
            <li>Admin can check stock: Administrators have access to a dashboard where they can view the current stock
              of blood units available in the blood bank.</li>
            <li>Admin can update and delete: Administrators can update and delete blood units from the stock, ensuring
              accurate inventory management.</li>
            <li>Admin can approve user requests: Administrators have the authority to review and approve blood requests
              made by users, ensuring they meet the necessary criteria.</li>
          </ul>
        </div>

        <div class="col-lg-6">
          <img src="blood_bank.svg" alt="Blood Bank" class="svg-img">
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container text-center mt-5">
      <p>&copy; 2023 Blood Bank. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>