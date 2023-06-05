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

        $query = 'INSERT INTO blood_donation (donation_id,userID,donor_name,age, blood_group, last_donated_date, quantity,contact_no, email, location,medical_history) VALUES(?,?,?,?,?,?,?,?,?,?,?)';
        $paramType = 'sssssssssss';
        $paramValue = array(
            $_POST["donation_id"],
            $_SESSION['userID'],
            $_POST["donor_name"],
            $_POST["age"],
            $_POST["blood_group"],
            $_POST["last_donated_date"],
            $_POST["quantity"],
            $_POST["contact_no"],
            $_POST["email"],
            $_POST["location"],
            $_POST["medical_history"],

        );
        $donorID = $this->conn->insert($query, $paramType, $paramValue);
        if (!empty($donorID)) {
            $response = array(
                "status" => "success",
                "message" => "You have registered successfully."
            );


        }
        return $response;

    }

}

if ($_POST) {

    $data = $_POST;
    print_r($data);

    $newDonor =
        new BloodManagement;

    $newDonor->insertDonor();
}
;

?>