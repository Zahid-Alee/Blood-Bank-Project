
<style>
table {
  background-color: #fff;
  border: 1px solid #ddd;
  font-family: 'Open Sans', sans-serif;
  font-size: 14px;
}

thead th {
  background-color: #941818 !important;
  color: #fff;
}

.table-icon {
  margin-right: 5px;
}

.table-icon i {
  color: #dc3545;
}

tbody tr:nth-of-type(odd) {
  background-color: #f8f9fa;
}

.action-icons {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.action-icons a {
  margin-right: 5px;
}

</style>

<table class="table table-striped table-bordered">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col"><i class="fas fa-user"></i> Name</th>
      <th scope="col"><i class="fas fa-tint"></i> Blood Group</th>
      <th scope="col"><i class="fas fa-heartbeat"> Units Available</th>
      <th scope="col"><i class="fas fa-map-marker-alt"></i> Location</th>
      <th scope="col" ><i class="fas fa-cog"></i> 
Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
// Sample data

// Establish a database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'blood-bank-management-system';

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Execute the query to retrieve the records from the blood_stock table
$sql = 'SELECT * FROM blood_stock';
$result = mysqli_query($connection, $sql);

// Store the results in an array
$stocks = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $stocks[] = $row;
  }
}

// Close the database connection
mysqli_close($connection);


// Loop through the stocks and repeat the HTML elements for each record
foreach ($stocks as $stock) {
  ?>

<tr>
    <th scope="row">

        <?php echo $stock['stock_id']; ?>
    </th>
      <td>
        <span class="table-icon"></span>
        <?php echo $stock['expiry_date']; ?>
      </td>
      <td>
        <span class="table-icon"><i class="fas fa-tint"></i></span>
        <?php echo $stock['blood_group']; ?>
      </td>
      <td>
        <span class="table-icon"></span>
        <?php echo $stock['quantity']; ?>
      </td>
      <td>
        <span class="table-icon"></span>
        New York City
      </td>
      <td>
        <a href="#" class="table-icon"><i class="fas fa-edit"></i></a>
        <a href="#" class="table-icon"><i class="fas fa-trash-alt"></i></a>
        <a href="#" class="table-icon"><i class="fas fa-sync-alt"></i></a>
      </td>
    </tr>
  <?php
}
?>
    
    <!-- Add more rows as needed -->
  </tbody>
</table>



