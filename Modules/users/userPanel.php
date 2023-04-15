<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Define a red color scheme */
        :root {
            --primary-color: #d32f2f;
            --text-color: #333;
        }

        /* Add box shadow and hover effects */
        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        /* Style the title and icons */
        .card-title {
            font-weight: bold;
            color: var(--primary-color);
        }

        .card-text {
            color: var(--text-color);
        }

        .card-text i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        /* Style the button */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }
    </style>
</head>

<body>
    
    <?php
 require_once './components/navbar.php';





use DataSource\DataSource;

require_once __DIR__ . '../../../lib/DataSource.php';

$con = new DataSource;
$query = 'SELECT * from   blood_donation where request_status="approved" ';
$paramType = 's';
$paramArray = array();
$bloodPosts = $con->select($query, $paramType, $paramArray);

if (!empty($bloodPosts)) {

    echo '<div class="container-fluid">';
    echo '<div class="row">';

    foreach ($bloodPosts as $Post) {

        echo '<div class="col-md-4 col-lg-3 mb-4">';
        echo '<div class="card h-100">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><i class="fas fa-user"></i> '.$Post['donor_name'].'</h5>';
        echo '<p class="card-text"><i class="fas fa-calendar-alt"></i> '.$Post['age'].'</p>';
        echo '<p class="card-text"><i class="fas fa-map-marker-alt"></i> '.$Post['location'].'</p>';
        echo '<p class="card-text"><i class="fas fa-tint"></i> '.$Post['blood_group'].'</p>';
        echo '<p class="card-text"><i class="fas fa-tint"></i> '.$Post['quantity'].'(ml)</p>';
        echo '<a href="#" class="btn btn-primary">Contat Donor</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';

} else {
    echo "<strong>No requests</strong>";
}
?>
</body>

</html>