<?php

use DataSource\DataSource;

class DonationHistoryModel
{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function getDonationHistory()
    {
        $query = 'SELECT donation_id, donation_date, last_donated_date, blood_group, quantity, location, donor_name, contact_no, email, age, request_status
                  FROM blood_donation
                  WHERE request_status = "approved"';

        $donationHistory = $this->conn->select($query);

        return $donationHistory;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $donationModel = new DonationHistoryModel();
    $donationHistory = $donationModel->getDonationHistory();

    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($donationHistory);
}
?>
