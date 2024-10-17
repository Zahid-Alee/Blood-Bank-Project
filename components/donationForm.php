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
      <label for="donorName">Full Name</label>
      <input type="text" class="form-control" name="donor_name" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
      <label for="donorAge">Age</label>
      <input type="number" class="form-control" name="age" min='18' max="40" placeholder="Enter your age" required>
    </div>
    <div class="form-group">
      <label for="donorAge">Last Donated At</label>
      <input type="date" class="form-control" name="last_donated_date" placeholder="Enter last donated date" required>
    </div>
    <div class="form-group">
      <label for="bloodType">Blood Group</label>
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
      <label for="donationQuantity">Quantity (ml)</label>
      <input type="number" class="form-control" name="quantity" min="460" max="500"
        placeholder="Enter the quantity in milliliters" required>
    </div>
    <div class="form-group">
      <label for="donorContact">Donor Contact</label>
      <input type="number" class="form-control" name="contact_no" placeholder="Enter your contact number" required>
    </div>
    <div class="form-group">
      <label for="donorEmail">Donor Email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your email address" required>
    </div>
    <div class="form-group">
      <label for="donorLocation">Address</label>
      <input type="text" class="form-control" name="location" placeholder="Enter your address" required>
    </div>

    <!-- Donor's Medical Health History -->
    <div class="form-group">
      <label for="medical_history">Medical Health History</label>
      <textarea class="form-control" name="medical_history" rows="5"
        placeholder="Enter your medical health history"></textarea>
    </div>

    <button type="submit" id="submit-btn" class="btn btn-danger closeModalBtn2"><i class="fas fa-paper-plane"></i>
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

  function validateForm() {
    const donorNameInput = document.querySelector('input[name="donor_name"]');
    const lastDonatedDateInput = document.querySelector('input[name="last_donated_date"]');
    const contactNumberInput = document.querySelector('input[name="contact_no"]');
    const emailInput = document.querySelector('input[name="email"]');
    const medicalHistoryInput = document.querySelector('textarea[name="medical_history"]');

    const donorName = donorNameInput.value.trim();
    const lastDonatedDate = new Date(lastDonatedDateInput.value);
    const contactNumber = contactNumberInput.value.trim();
    const email = emailInput.value.trim();
    const medicalHistory = medicalHistoryInput.value.trim();

    // Validation rules
    const nameRegex = /^[a-zA-Z\s]+$/;
    const contactNumberRegex = /^\d{11}$/;
    const emailRegex = /^\S+@\S+\.\S+$/;
    const currentDate = new Date();
    const minimumGapMonths = 4;
    const minimumGapMilliseconds = minimumGapMonths * 30 * 24 * 60 * 60 * 1000;

    // Validate donor name
    if (!nameRegex.test(donorName)) {
      alert('Invalid donor name. Name must contain only alphabetic characters and spaces.');
      donorNameInput.focus();
      return false;
    }

    // Validate last donated date
    if (currentDate - lastDonatedDate < minimumGapMilliseconds) {
      alert('You must wait at least 4 months before donating again.');
      lastDonatedDateInput.focus();
      return false;
    }

    // Validate contact number
    if (!contactNumberRegex.test(contactNumber)) {
      alert('Invalid contact number. Contact number must contain 11 digits.');
      contactNumberInput.focus();
      return false;
    }

    // Validate email
    if (!emailRegex.test(email)) {
      alert('Invalid email address.');
      emailInput.focus();
      return false;
    }

    // Validate medical history
    // Allow alphabets, spaces, digits, and special characters in medical history
    // Modify the regex pattern based on your specific requirements
    const medicalHistoryRegex = /^[\w\s\d]+$/;
    if (!medicalHistoryRegex.test(medicalHistory)) {
      alert('Invalid medical history. Medical history can contain alphabets, spaces, digits, and special characters.');
      medicalHistoryInput.focus();
      return false;
    }

    return true;
  }

  // Rest of the code remains the same


  function submitBloodDonationForm(event) {
    event.preventDefault();

    if (!validateForm()) {
      return;
    }

    const formValues = new FormData(event.target);
    fetch('http://localhost/BBM/Model/insertDonor.php', {
        method: 'POST',
        body: formValues
      })
      .then(response => response.text())
      .then(data => {
        console.log('inserted donor');
        createNotification('success', () => {

          alert("Your blood donation request has been submitted. ")
          // location.reload(); // Reload the page after the notification
        });
      })
      .catch((error) => {
        console.error('Error:', error);
        createNotification('error', () => {
          location.reload(); // Reload the page after the notification
        });
      });
  }
</script>