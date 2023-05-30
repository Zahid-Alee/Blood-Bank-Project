<div class="alerts-notifications">
  <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
    Success message here
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <div id="error-alert" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
    Not Enough Blood For This Blood Type
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

</div>
<div class="card-body">
  <form id="bloodDonationForm" method="post">
    <input type="text" name="donation_id" value="<?php echo uniqid('donor-') ?>" hidden>
    <div class="form-group">
      <label for="donorName"><i class="fas fa-user"></i> Donor Name</label>
      <input type="text" class="form-control" name="donor_name" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
      <label for="donorAge"><i class="fas fa-male"></i> Donor Age</label>
      <input type="number" class="form-control" name="age" min='18' max="40" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="donorAge"><i class="fas fa-male"></i> last donated date</label>
      <input type="date" class="form-control" name="last_donated_date" placeholder="Enter last donated date" required>
    </div>

    <div class="form-group">
      <label for="bloodType"><i class="fas fa-notes-medical"></i> Blood Type</label>
      <select class="form-control" name="blood_group" required>
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
      <label for="donorAge"><i class="fas fa-male"></i> Quantity</label>
      <input type="number" class="form-control" name="quantity" min='1' max="4" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="donorAge"><i class="fas fa-male"></i> Donor contact</label>
      <input type="number" class="form-control" name="contact_no" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="donorAge"><i class="fas fa-male"></i> Donor email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="donorAge"><i class="fas fa-male"></i> location</label>
      <input type="text" class="form-control" name="location" placeholder="Enter your age" required>
    </div>

    <button type="submit" id="submit-btn" class="btn btn-danger closeModalBtn2 "><i class="fas fa-paper-plane"></i>
      Submit</button>
  </form>
</div>

<style>
  label {

    font-weight: 500;
  }
</style>

<script>
  const successAlert = document.getElementById('success-alert');
  const errorAlert = document.getElementById('error-alert');

  const createNotification = (type, callback) => {
    const alertElement = type === 'error' ? errorAlert : successAlert;
    alertElement.classList.remove('d-none');
    const intervalId = setTimeout(() => {
      alertElement.classList.add('d-none');
      clearTimeout(intervalId);
      if (callback) {
        callback();
      }
    }, 1300);
  };

  const form = document.getElementById('bloodDonationForm');
  form.addEventListener('submit', submitBloodDonationForm);

  function submitBloodDonationForm(event) {
    event.preventDefault();
    const formValues = new FormData(event.target);
    fetch('http://localhost/BBM/Model/insertDonor.php', {
      method: 'POST',
      body: formValues
    })
      .then(response => response.text())
      .then(data => {
        console.log('Success:', data);
        createNotification('success', () => {
          location.reload(); // Reload the page after the notification
        });

      })
      .catch((error) => {
        console.error('error:', error);
        createNotification(responseData.status, () => {
          location.reload(); // Reload the page after the notification
        });
      });
  }
</script>