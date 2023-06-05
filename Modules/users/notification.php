<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="notification.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Notifications</title>
</head>

<body>
  <div class="container mt-5">
    <h1 class="p-4 text-center font-weight-bold">Notification Box</h1>
    <!-- <p>notification</p> -->

    <?php
    use DataSource\DataSource;

    require_once __DIR__ . '../../../lib/DataSource.php';
    $con = new DataSource;

    session_start();
    $loggedInUserID = $_SESSION['userID']; // Assuming you have the logged-in user's ID stored in the session
    
    $query = "SELECT * FROM user_notifications WHERE userID = ?";
    $paramType = "i";
    $paramValue = array($loggedInUserID);
    $notifications = $con->select($query, $paramType, $paramValue);

    if (!empty($notifications)) {
      $countNoti=count($notifications);
      foreach ($notifications as $notification) {
        $message = $notification['message'];
        $notFrom = $notification['notFrom'];

        $notificationTypeClass = $notFrom === 'BloodManagement' ? 'alert-success' : 'alert-danger';
        $notificationTitleIcon = $notFrom === 'BloodManagement' ? 'fas fa-user-shield' : 'fas fa-user';

        // Retrieve donation details based on donation_id
        $donationID = $notification['donation_id'];
        $donationQuery = "SELECT * FROM blood_donation WHERE donation_id = ?";
        $donationParamType = 's';
        $donationParamValue = array($donationID);
        $donationResult = $con->select($donationQuery, $donationParamType, $donationParamValue);

        if (!empty($donationResult)) {
          $donation = $donationResult[0];
          $donationDate = $donation['donation_date'];
          $lastDonatedDate = $donation['last_donated_date'];
          $bloodGroup = $donation['blood_group'];
          $quantity = $donation['quantity'];
          $location = $donation['location'];
          $donorName = $donation['donor_name'];
          $contactNo = $donation['contact_no'];
          $email = $donation['email'];
          $age = $donation['age'];
          $requestStatus = $donation['request_status'];

          ?>

          <div class="container">
            <div class="card notification-box">
              <div class="card-header">
                <h5 class="card-title">
                  <span>
                    <i class="<?php echo $notificationTitleIcon; ?> chat-icon pr-3"></i>Notification From
                    <?php echo ucfirst($notFrom); ?>
                  </span>

                  <span class="dissmiss-btn" onclick="delNotification(<?php echo $notification['notID'] ?>)">&times;</span>
                </h5>
              </div>
              <div class="card-body">
                <p class="card-text">
                  <?php echo $message; ?>
                </p>
                <strong class="donation-title">Donation Details:</strong>
                <div class="donation-details py-3">

                  <p><i class="fas fa-calendar pr-2"></i> <span class="bold">Donation Date:</span>
                    <?php echo $donationDate; ?>
                  </p>
                  <p><i class="fas fa-calendar-alt pr-2"></i> <span class="bold">Last Donated Date:</span>
                    <?php echo $lastDonatedDate; ?>
                  </p>
                  <p><i class="fas fa-tint pr-2"></i> <span class="bold">Blood Group:</span>
                    <?php echo $bloodGroup; ?>
                  </p>
                  <p><i class="fas fa-box pr-2"></i> <span class="bold">Quantity:</span>
                    <?php echo $quantity; ?>
                  </p>
                  <p><i class="fas fa-map-marker-alt pr-2"></i> <span class="bold">Location:</span>
                    <?php echo $location; ?>
                  </p>
                  <p><i class="fas fa-user pr-2"></i> <span class="bold">Donor Name:</span>
                    <?php echo $donorName; ?>
                  </p>
                  <p><i class="fas fa-phone pr-2"></i> <span class="bold">Contact No:</span>
                    <?php echo $contactNo; ?>
                  </p>
                  <p><i class="fas fa-envelope pr-2"></i> <span class="bold">Email:</span>
                    <?php echo $email; ?>
                  </p>
                  <p><i class="fas fa-user-clock pr-2"></i> <span class="bold">Age:</span>
                    <?php echo $age; ?>
                  </p>
                  <p><i class="fas fa-info-circle pr-2"></i> <span class="bold">Request Status:</span>
                    <?php echo $requestStatus; ?>
                  </p>
                  <div class="text-center mt-3 toggle-icon"  onclick="toggleOrderDetails(this)">
                  <i class="fa fa-chevron-down toggle-details"></i>
                </div>
                </div>
              </div>
            </div>
          </div>

          <?php
        } else {
          echo "<strong>No donation found for notification</strong>";
        }
      }
    } else {
      echo "<strong>No notifications found</strong>";
    }
    ?>
  </div>


  <script>

function toggleOrderDetails(icon) {
      var orderDetails = icon.parentElement.parentElement.querySelector('.order-details');
      orderDetails.classList.toggle('show');
    }
    const delNotification = (notID) => {

      fetch('/BBM/Model/handleNotification.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(notID)
      })
        .then(response => response.text())
        .then(data => {
          console.log('Response:', data);
          location.reload();
        })
        .catch(error => {
          console.error('Error:', error);
        });

    }
  </script>


</body>

</html>