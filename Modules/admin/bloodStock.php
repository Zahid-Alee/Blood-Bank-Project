<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
           
            <th scope="col" class='text-center'><i class="fas fa-sort-numeric-up"></i>
                Stock ID</th>
            <th scope="col" class='text-center'><i class="fas fa-tint"></i> Quatity </th>

            <th scope="col" class='text-center'><i class="fas fa-tint"></i> Blood Group</th>

            <th scope="col" class='text-center'><i class="fas fa-cog"></i>
                Action</th>
        </tr>
    </thead>
    <tbody><?php

            use DataSource\DataSource;

            require_once __DIR__ . '../../../lib/DataSource.php';

            $con = new DataSource;
            $query = 'SELECT stock_id, blood_group,quantity from blood_stock ';
            $paramType = 's';
            $paramArray = array();
            $stocks = $con->select($query, $paramType, $paramArray);

            if (!empty($stocks)) {

                foreach ($stocks as $stock) {


            ?>

                <tr>
                    <th scope="row" class='text-center'>
                        <?php echo $stock['stock_id']; ?>
                    </th>
                    <td>
                        <span class="table-icon"><i class="fas fa-tint"></i></span>
                        <?php echo $stock['quantity']; ?>
                    </td>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo $stock['blood_group']; ?>
                    </td>

                    <td class='text-center'>

                        <span class="table-icon text-danger px-2" onclick="deleteStock('<?php echo $stock['stock_id'] ?>')"><i class="fas fa-times"></i></span>
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
        //   console.log(stockID);
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
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>