<?php

use DataSource\DataSource;

class BloodManagement{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function insertDonor(){

        $query = 'INSERT INTO donors (donor_name, blood_group, last_donated_date, contact_no, email, address) VALUES(?,?,?,?,?,?)';
        $paramType = 'ssssss';
        $paramValue = array(
            $_POST["donor_name"],
            $_POST["blood_group"],
            $_POST["last_donated_date"],
            $_POST["contact_no"],
            $_POST["email"],
            $_POST["address"],
        );
        $donorID = $this->conn->insert($query, $paramType, $paramValue);
        if (! empty($donorID)) {
            $response = array(
                "status" => "success",
                "message" => "You have registered successfully."
            );
        }
    return $response;

    }

}



?>