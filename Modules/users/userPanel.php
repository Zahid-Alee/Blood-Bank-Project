<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Modules/users/user.css">
    <link rel="stylesheet" href="Modules/users/footer.css">
    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <?php include('./Modules/users/header.php') ?>
    <div class="user-page container p-0">
        <?php include('./Modules/users/services.php') ?>
        <div id="donation-popup" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Donate Blood Form</h2>
                    <span class="close-donation">&times;</span>
                </div>
                <div class="popup-body">
                    <?php include('./components/donationForm.php') ?>
                </div>

            </div>
        </div>
        <div id="request-popup" class="popup">
            <div class="popup-content">
                <div class="popup-header">
                    <h2>Request Blood From </h2>
                    <span class="close-request">&times;</span>
                </div>
                <div class="popup-body">
                    <?php include('./Modules/users/requestForm.php') ?>

                </div>

            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="header-section">
                    <h2 class="title">Donation <span>Posts</span></h2>
                    <p class="description">Engage with our donation post section to stay updated on the latest
                        opportunities and contribute to our life-saving mission.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <?php

                use DataSource\DataSource;

                require_once __DIR__ . '../../../lib/DataSource.php';

                $con = new DataSource;
                $query = 'SELECT * from   blood_donation where request_status="approved" ';
                $paramType = 's';
                $paramArray = array();
                $bloodPosts = $con->select($query, $paramType, $paramArray);

                if (!empty($bloodPosts)) {

                    foreach ($bloodPosts as $Post) {

                        echo '<div class="col-md-4 col-lg-3 mb-4 ">';
                        echo '<div class="card h-100">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title text-capitalize"><i class="fas fa-user pr-2 py-2"></i> ' . $Post['donor_name'] . '</h5>';
                        echo '<p class="card-text"><i class="fas fa-calendar-alt pr-2 py-2"></i> ' . $Post['age'] . '</p>';
                        echo '<p class="card-text"><i class="fas fa-map-marker-alt pr-2 py-2"></i> ' . $Post['location'] . '</p>';
                        echo '<p class="card-text"><i class="fas fa-tint pr-2 py-2"></i> ' . $Post['blood_group'] . '</p>';
                        echo '<p class="card-text"><i class="fas fa-tint pr-2 py-2"></i> ' . $Post['quantity'] . '(ml)</p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<strong>No requests</strong>";
                }
                ?>
            </div>
            <a href="#" class="btn btn-primary request-blood-btn">Request Blood</a>
        </div>
        <div class="custom-map-container  w-100">
            <div class="col-md-10 col-lg-8 mx-auto">
                <div class="header-section">
                    <h2 class="title">Find <span>Us</span></h2>
                    <p class="description">Easily find our blood bank's location on the embedded Google Map for
                        convenient navigation, directions, and a smooth visit experience.</p>
                </div>
            </div>
            <div class="content d-flex" style="justify-content:space-between;">
            <iframe class="custom-map w-45"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.177705176766!2d72.31188797547888!3d30.031759274930085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393c95446603cf47%3A0xa4c7c9803430aee0!2sCOMSATS%20University%20Islamabad%2C%20Vehari%20Campus!5e0!3m2!1sen!2s!4v1681643596890!5m2!1sen!2s"
                style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="side-img w-45" style="width:45%">
                <img  class="w-100" src="Modules/users/images/map-side-img.png" alt="">

                </div>
            </div>
           
        </div>

        <?php include('./Modules/users/contact.php') ?>
    </div>
    <?php include('./Modules/users/footer.php') ?>

</body>
<script>
    const changingBack = document.getElementById('changing-bg');
    const donationBtn = document.getElementById("openModalBtn");
    const requestBtn = document.querySelectorAll('.request-blood-btn')
    const donationPopUp = document.getElementById("donation-popup");
    const requestPopup = document.getElementById("request-popup")
    const closeDonBtn = document.querySelector(".close-donation");
    const closeReqBtn = document.querySelector(".close-request")


    donationBtn.onclick = function () {
        donationPopUp.style.display = "block";
    }
    closeDonBtn.onclick = function () {
        donationPopUp.style.display = "none";
    }
    requestBtn.forEach((reqBtn => {
        reqBtn.addEventListener('click', () => {
            requestPopup.style.display = 'block'
        })
    }))
    closeReqBtn.onclick = function () {
        requestPopup.style.display = "none";
    }
</script>

</html>