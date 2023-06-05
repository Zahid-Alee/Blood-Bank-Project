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

<table class="table table-striped table-bordered">
    <h3 class="page-heading">Blood Requests</h3>

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
                        <span class="table-icon text-success px-2"
                            onclick="acceptReq('<?php echo $reqID ?>','<?php echo $quantityReq ?>','<?php echo $blood_group ?>')"><i
                                class="fas fa-check"></i></span>
                        <!-- -->
                        <span class="table-icon text-danger px-2" onclick="rejReq('<?php echo $reqID ?>')"><i
                                class="fas fa-times"></i></span>
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

    const fetchCall = async (url, method, requestData) => {
        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(requestData),
            });

            const responseData = await response.json();
            return responseData;
            // location.reload();
        } catch (error) {
            console.error('Error:', error);
            return error;
        }
    };

    const acceptReq = async (reqID, quantity, blood_group) => {
        const requestData = {
            request_id: reqID,
            quantity: quantity,
            blood_group: blood_group,
            method: 'accept',
            request_status: 'approved',
        };

        try {
            const responseData = await fetchCall('Model/handleBloodReq.php', 'POST', requestData);
            createNotification(responseData.status, () => {
                location.reload(); // Reload the page after the notification
            });
            location.reload()
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const rejReq = async (reqID) => {
        const requestData = {
            request_id: reqID,
            method: 'reject',
        };

        try {
            await fetchCall('Model/handleBloodReq.php', 'POST', requestData);
            createNotification(responseData.status, () => {
                // location.reload(); // Reload the page after the notification
            });
            location.reload(); // Reload the page after rejecting the request
        } catch (error) {
            console.error('Error:', error);
        }
    };

</script>