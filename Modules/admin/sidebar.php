<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  body{
    color: whitesmoke;
  }

  #navigation{

    display: none;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 260px;
    color:#11101d;
    /* background: #11101d; */
    z-index: 100;
    /* transition: all 0.5s ease; */
    opacity: 1;
  }

  .sidebar.close {
    width: 78px;
  }

  .sidebar .logo-details {
    height: 60px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
  }

  .sidebar .logo-details i {
    font-size: 30px;
    color: #fff;
    height: 50px;
    min-width: 78px;
    text-align: center;
    line-height: 50px;
  }

  .sidebar .logo-details .logo_name {
    font-size: 22px;
    /* color: #fff; */
    font-weight: 600;
    transition: 0.3s ease;
    transition-delay: 0.1s;
  }

  .sidebar.close .logo-details .logo_name {
    transition-delay: 0s;
    opacity: 0;
    pointer-events: none;
  }

  .sidebar .nav-links {
    height: 100%;
    padding: 30px 0 150px 0;
    overflow: auto;
  }

  .sidebar.close .nav-links {
    overflow: visible;
  }

  .sidebar .nav-links::-webkit-scrollbar {
    display: none;
  }

  .sidebar .nav-links li {
    position: relative;
    list-style: none;
    /* transition: all 0.4s ease; */
  }

  .sidebar .nav-links li:hover i {
   /* background: #b93b3b; */
    /* border-radius: 5px; */
    color: #c41818;
    transform: scale(1.5, 1.5);
  }

  .sidebar .nav-links li .iocn-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .sidebar.close .nav-links li .iocn-link {
    display: block
  }

  .sidebar .nav-links li i {
    height: 50px;
    min-width: 50px;
    text-align: center;
    line-height: 50px;
    color: #11101d;
    font-size: 20px;
    cursor: pointer;
    /* transition: all 0.3s ease; */
  }

  .sidebar .nav-links li.showMenu i.arrow {
    transform: rotate(-180deg);
  }

  .sidebar.close .nav-links i.arrow {
    display: none;
  }

  .sidebar .nav-links li a {
    display: flex;
    align-items: center;
    text-decoration: none;
  }

  .sidebar .nav-links li a .link_name {
    /* font-size: 18px; */
    font-weight: 400;
    color: #11101d;
    /* transition: all 0.4s ease; */
  }

  .sidebar.close {
    opacity: 1 !important;
  }

  .sidebar.close .nav-links li a .link_name {
    opacity: 0;
    pointer-events: none;
  }

  .sidebar .nav-links li .sub-menu {
    padding: 5px;
    margin-top: -10px;
    font-size: 15px;
    background: #c41818;
    display: none;
    text-shadow: none !important;
  }

  .sidebar .nav-links li.showMenu .sub-menu {
    display: block;
  }
  .sidebar .nav-links li .sub-menu a {
    color: #efe6e6;
    font-size: 13px !important;
    font-weight: 400;
    margin: 10px 20px;
    white-space: nowrap;
    transition: all 0.3s ease;
  }

  .sidebar .nav-links li .sub-menu a:hover {
    opacity: .8;
    /* background-color: indianred; */
  }

  .sidebar.close .nav-links li .sub-menu {
    position: absolute;
    left: 100%;
    top: -10px;
    margin-top: 0;
    padding: 10px 20px;
    border-radius: 0 6px 6px 0;
    opacity: 0;
    display: block;
    pointer-events: none;
    transition: 0s;
  }

  .sidebar.close .nav-links li:hover .sub-menu {
    top: 0;
    opacity: 1 !important;
    pointer-events: auto;
    /* transition: all 0.4s ease; */
  }

  .sidebar .nav-links li .sub-menu .link_name {
    display: none;
  }

  .sidebar.close .nav-links li .sub-menu .link_name {
    font-size: 15px;
    font-weight: 400;
    opacity: 1;
    display: block;
  }

  .sidebar .nav-links li .sub-menu.blank {
    opacity: 1;
    pointer-events: auto;
    padding: 3px 20px 6px 16px;
    opacity: 0;
    pointer-events: none;
  }

  .sidebar .nav-links li:hover .sub-menu.blank {
    top: 50%;
    transform: translateY(-50%);
  }

  .sidebar .profile-details {
    position: fixed;
    bottom: 0;
    width: 260px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    background: #c41818;
    padding: 12px 0;
    /* transition: all 0.5s ease; */
  }

  .sidebar.close .profile-details {
    background: none;
  }

  .sidebar.close .profile-details {
    width: 78px;
  }

  .sidebar .profile-details .profile-content {
    display: flex;
    align-items: center;
  }

  .sidebar .profile-details img {
    height: 52px;
    width: 52px;
    object-fit: cover;
    border: 2px solid white;
    border-radius: 50px;
    margin: 0 14px 0 12px;
    /* background: #1d1b31; */
    /* transition: all 0.5s ease; */
  }

  .sidebar.close .profile-details img {
    padding: 10px;
  }

  .sidebar .profile-details .profile_name,
  .sidebar .profile-details .job {
    color: #fff;
    /* font-size: 18px; */
    font-weight: 500;
    white-space: nowrap;
  }

  .sidebar.close .profile-details i,
  .sidebar.close .profile-details .profile_name,
  .sidebar.close .profile-details .job {
    display: none;
  }

  .sidebar .profile-details .job {
    font-size: 12px;
  }

  .home-section {
    position: absolute;
    top: 0;
    background: #dcc0c029;
    height: 100vh;
    left: 260px;
    width: calc(100% - 260px);
    /* transition: all 0.3s ease; */
  }

  .sidebar.close~.home-section {
    left: 78px;
    width: calc(100% - 78px);
  }

  .home-section .home-content {
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-right: 50px;
    background: #fff;
  }

  .home-section .home-content .bx-menu,
  .home-section .home-content .text {
    color: #11101d;
    font-size: 35px;
  }

  .home-section .home-content .bx-menu {
    margin: 0 15px;
    cursor: pointer;
  }

  .home-section .home-content .text {
    font-size: 26px;
    font-weight: 600;
  }

  @media (max-width: 400px) {
    .sidebar.close .nav-links li .sub-menu {
      display: none;
    }

    .sidebar {
      width: 78px;
    }

    .sidebar.close {
      width: 0;
    }

    .home-section {
      left: 78px;
      width: calc(100% - 78px);
      z-index: 100;
    }

    .sidebar.close~.home-section {
      width: 100%;
      left: 0;
    }
  }
</style>

<div class="logo-details container">
  <!-- <i class='bx bxl-c-plus-plus'></i> -->
  <span class="logo_name">Blood Bank</span>
</div>
<ul class="nav-links">
  <li>
    <a  href="?link=dashboard">
      <i class='bx bx-grid-alt'></i>
      <span class="link_name">DashBoard</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name"  href="?link=dashboard">DashBoard</a></li>
    </ul>
  </li>
  <li>
    <div class="iocn-link">
      <a href="#">
        <i class='bx bx-collection'></i>
        <span class="link_name">Requests</span>
      </a>
      <i class='bx bxs-chevron-down arrow'></i>
    </div>
    <ul class="sub-menu">
      <li><a class="link_name" href="#">Category</a></li>
      <a class="nav-link" href="?link=bloodRequest">
        <li style="list-style:disc"> Blood Requests
        </li>
        <a class="nav-link" href="?link=donationRequest">
          
          <li style="list-style:disc">Donation Requests </li>

        </a>
      </a>
    </ul>
  </li>

  <li>
    <a href="?link=bloodStock">
      <i class='bx bx-line-chart'></i>
      <span class="link_name">Check Stock</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name"  href="?link=bloodStock">Check Stock</a></li>
    </ul>
  </li>

  <li>
    <a href="?link=donationForm">
      <i class='bx bx-user-plus'></i>
      <span class="link_name">Add Donors</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name" href="?link=donationForm">Add Donors</a></li>
    </ul>
  </li>

  <li>
    <a href="#">
      <i class='bx bx-cog'></i>
      <span class="link_name">Setting</span>
    </a>
    <ul class="sub-menu blank">
      <li><a class="link_name" href="#">Setting</a></li>
    </ul>
  </li>
  <li>
    <div class="profile-details">
      <div class="profile-content">
        <!-- <img src="image/profile.jpg" alt="profile"> -->
        <i class='bx bx-user text-light'></i>
      </div>
      <div class="name-job">
        <div class="profile_name">
          <?php  echo $_SESSION['username'] ?>
        </div>
        <div class="job" style="color:#43ffe5">
         <?php echo $_SESSION["role"] ?> 
        </div>
      </div>
     <a href="logout.php"><i class='bx bx-log-out text-light'></i></a>
    </div>
  </li>
</ul>