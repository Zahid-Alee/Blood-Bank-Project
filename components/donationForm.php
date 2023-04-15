<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Static Sidebar Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .sidebar {
      /* position: fixed; */
      top: 6px;
      bottom: 0;
      left: 0;
      z-index: 100;
      padding: 48px 0 0;
      box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }

    .sidebar-sticky {
      position: relative;
      top: 0;
      height: calc(100vh - 48px);
      padding-top: .5rem;
      overflow-x: hidden;
      overflow-y: auto;
    }

    a {
      color: aliceblue;
    }

    a:hover {
      color: rgb(186, 184, 184);
    }
  </style>
</head>

<body>


  <!-- Navigation Bar -->
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
    </div> -->


  <div class="card-body">
    <form id="bloodDonationForm" method="post">
      <input type="text" name="donation_id" value="<?php echo uniqid('donor-') ?>" hidden  >
      <div class="form-group">
        <label for="donorName"><i class="fas fa-user"></i> Donor Name</label>
        <input type="text" class="form-control"  name="donor_name" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="donorAge"><i class="fas fa-male"></i> Donor Age</label>
        <input type="number" class="form-control"  name="age" placeholder="Enter your age">
      </div>
      <div class="form-group">
        <label for="donorAge"><i class="fas fa-male"></i> last donated date</label>
        <input type="date" class="form-control" name="last_donated_date" placeholder="Enter last donated date">
      </div>
      
          <div class="form-group">
            <label for="bloodType"><i class="fas fa-notes-medical"></i> Blood Type</label>
            <select class="form-control"  name="blood_group">
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
        <input type="number" class="form-control"  name="quantity" max="4" min='1' placeholder="Enter your age">
      </div>
      <div class="form-group">
        <label for="donorAge"><i class="fas fa-male"></i> Donor contact</label>
        <input type="number" class="form-control"  name="contact_no" placeholder="Enter your age">
      </div>
      <div class="form-group">
        <label for="donorAge"><i class="fas fa-male"></i> Donor email</label>
        <input type="email" class="form-control"  name="email" placeholder="Enter your age">
      </div>
      <div class="form-group">
        <label for="donorAge"><i class="fas fa-male"></i> location</label>
        <input type="text" class="form-control"  name="location" placeholder="Enter your age">
      </div>

      <button type="submit" id="submit-btn" class="btn btn-danger "><i class="fas fa-paper-plane"></i> Submit</button>
    </form>
  </div>

  <script>
    const form = document.getElementById('bloodDonationForm');
    form.addEventListener('submit', submitBloodDonationForm);

    function submitBloodDonationForm(event) {
      event.preventDefault(); // prevent form from submitting and page reload
      const formValues = new FormData(event.target);
      fetch('Model/insertDonor.php', {
          method: 'POST',
          body: formValues
        })
        .then(response => response.text())
        .then(data => {
          console.log('Success:', data);
          // handle success response here
        })
        .catch((error) => {
          console.error('Error:', error);
          // handle error response here
        });
    }
  </script>


  </div>

  <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
  </div>
  </main>
  </div>

  </div>

</body>

</html>