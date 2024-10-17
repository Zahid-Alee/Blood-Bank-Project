<?php

use DataSource\DataSource;

class DonorHealth
{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function donorHealth()
    {
        $query = 'SELECT *
                  FROM blood_donation';

        $donorHealth = $this->conn->select($query);

        return $donorHealth;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $donorHealth = new DonorHealth();
    $healthData = $donorHealth->donorHealth();

    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($healthData);
}
?>