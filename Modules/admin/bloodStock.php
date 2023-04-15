<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class='text-center'><i class="fas fa-user"></i> donor name</th>
            <th scope="col" class='text-center'><i class="fas fa-sort-numeric-up"></i>
                Units Available</th>
            <th scope="col" class='text-center'><i class="fas fa-tint"></i> Blood Group</th>
            <th scope="col" class='text-center'><i class="fas fa-map-marker-alt"></i> date</th>

            <th scope="col" class='text-center'><i class="fas fa-map-marker-alt"></i> Location</th>
            

            <th scope="col" class='text-center'><i class="fas fa-cog"></i>
                Action</th>
        </tr>
    </thead>
    <tbody><?php

            use DataSource\DataSource;

            require_once __DIR__ . '../../../lib/DataSource.php';

            $con = new DataSource;
            $query = 'SELECT blood_stock.blood_group,blood_stock.quantity,blood_stock.location,blood_stock.donation_id ,donor_name,donation_date from blood_stock inner join blood_donation on
            blood_stock.donation_id = blood_donation.donation_id';
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
                        <span class="table-icon"><i class="fas fa-tint"></i></span>
                        <?php echo $stock['quantity']; ?>
                    </td>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo $stock['blood_group']; ?>
                    </td>
                    
                    <td>
                        <span class="table-icon"><i class="fas fa-tint"></i></span>
                        <?php echo $stock['donation_date']; ?>
                    </td>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo substr($stock['location'], 0, 20) . '....'; ?>
                    </td>
                    <td class='text-center'>

                        <span class="table-icon text-danger px-2" onclick="deleteStock('<?php $id=$stock['stock_id'];echo $id;  ?>')"><i class="fas fa-times"></i></span>
                    </td>
                </tr>
        <?php
                }
            } else {
                echo "<strong>No requests</strong>";
            }
        ?>
    </tbody>
</table>

<script>
    // let method, result;

    const deleteStock = async (stock_id) => {
  const stockID = {
    stock_id: stock_id
  };
  console.log(stockID);

  fetch('Model/handleStock.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(stockID)
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