<div class="card-body">
  <form id="requestBlood" method="post">
    <input type="text" name="request_id" value="<?php echo uniqid('request-') ?>" hidden>
    <div class="form-group">
      <label for="hospitalName"><i class="fas fa-hospital"></i> Hospital Name</label>
      <input type="text" class="form-control" id="hospitalName" name="hospital_name" placeholder="Enter Hospital Name"
        required>
    </div>
    <div class="form-group">
      <label for="bloodType"><i class="fas fa-notes-medical"></i> Blood Type</label>
      <select class="form-control" id="bloodType" name="blood_group" required>
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
      <label for="quantity"><i class="fas fa-male"></i> Quantity</label>
      <input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="Enter Quantity"
        required>
    </div>
    <div class="form-group">
      <label for="contact"><i class="fas fa-male"></i>Contact</label>
      <input type="number" class="form-control" id="contact" name="contact_no" placeholder="Enter your Contact"
        required>
    </div>
    <div class="form-group">
      <label for="location"><i class="fas fa-male"></i> Location</label>
      <input type="text" class="form-control" id="location" name="location" placeholder="Enter your Location" required>
    </div>
    <button type="submit" id="submit-btn" class="btn btn-danger closeModalBtn2"><i class="fas fa-paper-plane"></i>
      Submit</button>
  </form>
</div>


<script>
  // Request Form Validation
  // Request Form Validation
  const reqForm = document.getElementById('requestBlood');
  reqForm.addEventListener('submit', submitBloodDonationForm);

  function submitBloodDonationForm(event) {
    event.preventDefault();

    if (!validateRequestForm()) {
      return;
    }

    const formValues = new FormData(event.target);

    fetch('http://localhost/BBM/Model/makeRequest.php', {
      method: 'POST',
      body: formValues,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log('Success:', data);
        location.reload();
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }

  function validateRequestForm() {
    const hospitalNameInput = document.getElementById('hospitalName');
    const bloodGroupInput = document.getElementById('bloodType');
    const quantityInput = document.getElementById('quantity');
    const contactInput = document.getElementById('contact');
    const locationInput = document.getElementById('location');

    const hospitalName = hospitalNameInput.value.trim();
    const bloodGroup = bloodGroupInput.value;
    const quantity = quantityInput.value.trim();
    const contact = contactInput.value.trim();
    const location = locationInput.value.trim();

    // Validation rules
    const nameRegex = /^[A-Za-z\s]+$/;
    const quantityRegex = /^\d+$/;
    const contactRegex = /^\d{1,11}$/;

    // Validate hospital name
    if (!nameRegex.test(hospitalName)) {
      alert('Invalid hospital name. Hospital name must contain only alphabetic characters and spaces.');
      hospitalNameInput.focus();
      return false;
    }

    // Validate blood group
    if (bloodGroup === '') {
      alert('Please select a blood type.');
      bloodGroupInput.focus();
      return false;
    }

    // Validate quantity
    if (!quantityRegex.test(quantity) || quantity < 500 || quantity > 1000) {
      alert('Invalid quantity. Quantity must be 500ml - 1000ml only.');
      quantityInput.focus();
      return false;
    }

    // Validate contact
    if (!contactRegex.test(contact)) {
      alert('Invalid contact number. Contact number must be a valid 11-digit number.');
      contactInput.focus();
      return false;
    }

    // Validate location
    if (location.length === 0) {
      alert('Please enter a location.');
      locationInput.focus();
      return false;
    }

    return true;
  }


</script>