<div class="alerts-notifications">
  <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
    Success message here
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
    Error Alerts
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>
<table class="table table-striped table-bordered">
  <h3 class="page-heading">Donation Requests</h3>
  <thead class="thead-dark">
    <tr>
      <th scope="col" class='text-center'><i class="fas fa-user"></i> Name</th>
      <th scope="col" class='text-center'><i class="fas fa-sort-numeric-up"></i>
        Units Available</th>
      <th scope="col" class='text-center'><i class="fas fa-tint"></i> Blood Group</th>
      <th scope="col" class='text-center'><i class="fas fa-birthday-cake"></i>
        Age</th>
      <th scope="col" class='text-center'><i class="fas fa-map-marker-alt"></i> Location</th>

      <th scope="col" class='text-center'><i class="fas fa-cog"></i>
        Action</th>
    </tr>
  </thead>
  <tbody>
    <?php

    use DataSource\DataSource;

    require_once __DIR__ . '../../../lib/DataSource.php';

    $con = new DataSource;
    $query = 'SELECT * from blood_donation where request_status= "pending"';
    $paramType = 's';
    $paramArray = array();
    $stocks = $con->select($query, $paramType, $paramArray);
    if (!empty($stocks)) {

      foreach ($stocks as $stock) {


        ?>
        <tr>
          <th scope="row" class='text-center'>
            <?php echo $stock['donor_name']; ?>
          </th>
          <td>
            <span class="table-icon"></span>
            <?php echo $stock['blood_group']; ?>
          </td>
          <td>
            <span class="table-icon"><i class="fas fa-tint"></i></span>
            <?php echo $stock['quantity']; ?>
          </td>
          <td>
            <span class="table-icon"></span>
            <?php echo $stock['age']; ?>

          </td>
          <td>
            <span class="table-icon"></span>
            <?php echo substr($stock['location'], 0, 20) . '....'; ?>
          </td>
          <td class='text-center'>
            <span class="table-icon text-success px-2"
              onclick="insertStock(<?php echo htmlspecialchars(json_encode($stock), ENT_QUOTES, 'UTF-8'); ?>,'<?php echo uniqid('stock-') ?>')"><i
                class="fas fa-check"></i></span>

            <span class="table-icon text-danger px-2" onclick="deleteDonor('<?php echo $stock['donation_id'] ?>')"><i
                class="fas fa-times"></i></span>


          </td>
        </tr>
        <?php
      }
    } else {
      echo "<strong class ='text-danger'>No requests</strong>";
    }
    ?>
  </tbody>
</table>
<script>
  const successAlert = document.getElementById('success-alert');
  const errorAlert = document.getElementById('error-alert');

  const createNotification = (type, message, callback) => {
    const alertElement = type === 'error' ? errorAlert : successAlert;
    alertElement.innerHTML = message;
    alertElement.classList.remove('d-none');
    const intervalId = setTimeout(() => {
      alertElement.classList.add('d-none');
      clearTimeout(intervalId);
      if (callback) {
        callback();
      }
    }, 2000);
  };

  const fetchCall = async (url, method, requestData) => {
    try {
      const response = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData),
      });

      const responseData = await response.text();
      return responseData;
    } catch (error) {
      console.error('Error:', error);
      return error;
    }
  };

  const insertStock = async (data, stockID) => {
    const requestData = {
      stock_id: stockID,
      stock: data,
      method: 'accept',
      request_status: 'approved',
    };

    try {
      const responseData = await fetchCall('Model/handleDonationReq.php', 'POST', requestData);
      console.log(responseData);
      // createNotification('sucess', 'Your Request Has been Accepted' () => {
      location.reload(); // Reload the page after the notification
      // });
    } catch (error) {
      console.error('Error:', error);
    }
  };

  const deleteDonor = async (donorID) => {
    const requestData = {
      donation_id: donorID,
      method: 'reject',
    };

    try {
      const responseData = await fetchCall('Model/handleDonationReq.php', 'POST', requestData);
      console.log(responseData);
      createNotification('success', 'Rejected Donation Request', () => {
        location.reload(); // Reload the page after the notification
      });
    } catch (error) {
      console.error('Error:', error);
    }
  };

</script>