<?php

use DataSource\DataSource;

class BloodManagement
{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function insertDonor()
    {
        session_start();

        try {
            // Corrected the query and paramType based on table structure, removed medical_history
            $query = 'INSERT INTO blood_donation (donation_id, userID, donor_name, age, blood_group, last_donated_date, quantity, contact_no, email, location,medical_history) 
                      VALUES(?,?,?,?,?,?,?,?,?,?,?)';
            $paramType = 'sisisssssss';
            $paramValue = [
                $_POST["donation_id"],      // varchar
                $_SESSION['userID'],        // int (foreign key)
                $_POST["donor_name"],       // varchar
                $_POST["age"],              // int
                $_POST["blood_group"],      // varchar
                $_POST["last_donated_date"], // date
                $_POST["quantity"],         // int
                $_POST["contact_no"],       // varchar
                $_POST["email"],            // varchar
                $_POST["location"],       // varchar
                $_POST["medical_history"]          // varchar
            ];

            // Execute the query
            $donorID = $this->conn->insert($query, $paramType, $paramValue);

            // Check if insertion was successful
            if (!empty($donorID)) {
                $response = array(
                    "status" => "success",
                    "message" => "You have registered successfully."
                );
            } else {
                throw new Exception("Failed to insert donor details.");
            }
        } catch (Exception $e) {
            // Handle exception and return an error message
            $response = array(
                "status" => "error",
                "message" => "Error: " . $e->getMessage()
            );
        }

        return $response;
    }
}

// Handle POST request
if ($_POST) {
    try {
        $newDonor = new BloodManagement();
        $response = $newDonor->insertDonor();
    } catch (Exception $e) {
        // Catch any unexpected error at the outer level
        $response = [
            "status" => "error",
            "message" => "Failed to process request: " . $e->getMessage()
        ];
    }

    // Return the response in JSON format for debugging
    header('Content-Type: application/json');
    echo json_encode($response);
}
