<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class='text-center'><i class="fas fa-user"></i> Hospital</th>
            <th scope="col" class='text-center'><i class="fas fa-sort-numeric-up"></i>
                Units </th>
            <th scope="col" class='text-center'><i class="fas fa-tint"></i> Blood Group</th>
            <th scope="col" class='text-center'><i class="fas fa-birthday-cake"></i>
                Requested Date</th>
            <th scope="col" class='text-center'><i class="fas fa-map-marker-alt"></i> Location</th>
            <th scope="col" class='text-center'><i class="fas fa-cog"></i>
                Action</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use DataSource\DataSource;

        require_once __DIR__ . '../../../lib/DataSource.php';

        $con = new DataSource;
        $query = 'SELECT * from blood_requests where request_status= "pending"';
        $paramType = 's';
        $paramArray = array();
        $requests = $con->select($query, $paramType, $paramArray);
        if (!empty($requests)) {

            foreach ($requests as $request) {

        ?>
                <tr>
                    <th scope="row" class='text-center'>
                        <?php echo $request['hospital_name']; ?>
                    </th>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo $request['quantity']; ?>
                    </td>
                    <td>
                        <span class="table-icon"><i class="fas fa-tint"></i></span>
                        <?php echo $request['blood_group']; ?>
                    </td>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo $request['request_date']; ?>

                    </td>
                    <td>
                        <span class="table-icon"></span>
                        <?php echo substr($request['location'], 0, 20) . '....'; ?>
                    </td>
                    <td class='text-center'>
                        <?php
                        $reqID = $request['request_id'];
                        $quantityReq = $request['quantity'];
                        $blood_group = $request['blood_group'];
                        ?>
                        <span class="table-icon text-success px-2" onclick="acceptReq('<?php echo $reqID ?>','<?php echo $quantityReq ?>','<?php echo $blood_group ?>')"><i class="fas fa-check"></i></span>
                        <!-- -->
                        <span class="table-icon text-danger px-2" onclick="rejReq('<?php echo $reqID ?>')"><i class="fas fa-times"></i></span>
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
    let method, result, data;
    const acceptReq = async (reqID, quantity, blood_group) => {
        try {
            const data = {
                request_id: reqID,
                quantity: quantity,
                blood_group: blood_group,
                method: 'accept',
                request_status: 'approved'
            }
            const result = await postReq(data); // wait for the Promise to resolve
            console.log(result);
            // location.reload();
        } catch (error) {
            console.error('Error:', error);
        }
    }


    const rejReq = async (reqID) => {

        const data = {
            request_id: reqID,
            method: 'reject'
        }
        result = await postReq(data); // wait for the Promise to resolve
        console.log(result);
        location.reload();
    }

    const postReq = async (data) => {
        // console.log(data)
        try {
            // console.log(data ,'method accepted')
            const response = await fetch('Model/handleBloodReq.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
            const responseData = await response.text();
            return responseData;
        } catch (error) {
            console.error('Error:', error);
            return error;
        }
    }
</script>