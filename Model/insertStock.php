<?php

use DataSource\DataSource;


class BloodManagement{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '../../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function insertDonor(){

        $query = 'INSERT INTO blood_stock (stock_id,donation_id, blood_group, quantity,quantity) VALUES(?,?,?,?,?)';
        $paramType = 'sssss';
        $paramValue = array(
            $_POST["stock_id"],
            $_POST["donation_id"],
            $_POST["blood_group"],
            $_POST["quantity"],
            $_POST["last_donated_date"],
            $_POST["quantity"],

        );
        $stockID = $this->conn->insert($query, $paramType, $paramValue);
        if (! empty($stockID)) {
            $response = array(
                "status" => "success",
                "message" => "You have registered successfully."
            );
}
    return $response;

    }

}

if($_POST){

    $data = $_POST;
    print_r($data);

    $inserDonor = new BloodManagement;

 $inserDonor->insertDonor();
   };
