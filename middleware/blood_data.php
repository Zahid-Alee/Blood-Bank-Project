<?php

// user DataSource
use DataSource\DataSource;


class Middleware
{
       private $conn;
    

    // Function to insert a new donor into the donors table
    public function insertDonor($donor_id, $donor_name, $blood_group, $last_donated_date, $contact_no, $email, $address)
    {
        $stmt = $this->conn->prepare("INSERT INTO donors (donor_id, donor_name, blood_group, last_donated_date, contact_no, email, address) VALUES (:donor_id, :donor_name, :blood_group, :last_donated_date, :contact_no, :email, :address)");
        $stmt->bindParam(':donor_id', $donor_id);
        $stmt->bindParam(':donor_name', $donor_name);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':last_donated_date', $last_donated_date);
        $stmt->bindParam(':contact_no', $contact_no);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }

    // Function to update a donor in the donors table
    public function updateDonor($donor_id, $donor_name, $blood_group, $last_donated_date, $contact_no, $email, $address)
    {
        $stmt = $this->conn->prepare("UPDATE donors SET donor_name=:donor_name, blood_group=:blood_group, last_donated_date=:last_donated_date, contact_no=:contact_no, email=:email, address=:address WHERE donor_id=:donor_id");
        $stmt->bindParam(':donor_id', $donor_id);
        $stmt->bindParam(':donor_name', $donor_name);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':last_donated_date', $last_donated_date);
        $stmt->bindParam(':contact_no', $contact_no);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    }

    // Function to delete a donor from the donors table
    public function deleteDonor($donor_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM donors WHERE donor_id=:donor_id");
        $stmt->bindParam(':donor_id', $donor_id);
        $stmt->execute();
    }

    // Function to check the stock for a specific blood group
    public function checkStock($blood_group)
    {
        $stmt = $this->conn->prepare("SELECT quantity FROM blood_stock WHERE blood_group=:blood_group AND expiry_date > NOW() ORDER BY expiry_date ASC");
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $total_quantity = 0;
        foreach ($result as $row) {
            $total_quantity += $row['quantity'];
        }
        return $total_quantity;
    }

    // Function to search for available blood in the blood_stock table
    public function searchBlood($blood_group)
    {
        $stmt = $this->conn->prepare("SELECT * FROM blood_stock WHERE blood_group=:blood_group AND expiry_date > NOW() ORDER BY expiry_date ASC");
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to insert a new stock into the blood_stock table
    public function insertStock($stock_id, $blood_group, $quantity, $expiry_date, $location)
    {
        $stmt = $this->conn->prepare("INSERT INTO blood_stock (stock_id, blood_group, quantity, expiry_date, location) VALUES (:stock_id, :blood_group, :quantity, :expiry_date, :location)");
        $stmt->bindParam(':stock_id', $stock_id);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':expiry_date', $expiry_date);
        $stmt->bindParam(':location', $location);
        $stmt->execute();
    }

    // Function to update a stock in the blood_stock table
    public function updateStock($stock_id, $blood_group, $quantity, $expiry_date, $location)
    {
        $stmt = $this->conn->prepare("UPDATE blood_stock SET blood_group=:blood_group, quantity=:quantity, expiry_date=:expiry_date, location=:location WHERE stock_id=:stock_id");
        $stmt->bindParam(':stock_id', $stock_id);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':expiry_date', $expiry_date);
        $stmt->bindParam(':location', $location);
        $stmt->execute();
    }

    // Function to delete a stock from the blood_stock table
    public function deleteStock($stock_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM blood_stock WHERE stock_id=:stock_id");
        $stmt->bindParam(':stock_id', $stock_id);
        $stmt->execute();
    }

    // Function to insert a new request into the blood_requests table
    public function insertRequest($request_id, $hospital_name, $blood_group, $quantity, $request_date, $location)
    {
        $stmt = $this->conn->prepare("INSERT INTO blood_requests (request_id, hospital_name, blood_group, quantity, request_date, request_status, location) VALUES (:request_id, :hospital_name, :blood_group, :quantity, :request_date, 'Pending', :location)");
        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':hospital_name', $hospital_name);
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':request_date', $request_date);
        $stmt->bindParam(':location', $location);
        $stmt->execute();
    }

    // Function to update a request in the blood_requests table
    public function updateRequest($request_id, $request_status)
    {
        $stmt = $this->conn->prepare("UPDATE blood_requests SET request_status=:request_status WHERE request_id=:request_id");
        $stmt->bindParam(':request_id', $request_id);
        $stmt->bindParam(':request_status', $request_status);
        $stmt->execute();
    }
}


?>