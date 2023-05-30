<?php
use DataSource\DataSource;

class BloodManagement
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '../../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    public function createAdminNotification($id)
    {
        $query = "SELECT userID FROM blood_donation WHERE donation_id = ?";
        $paramType = "s";
        $paramValue = array($id);
        $user = $this->conn->select($query, $paramType, $paramValue);

        if (!empty($user)) {
            $userID = $user[0]['userID'];

            $message = "Your Blood Request Has Been Accepted";
            $query = "INSERT INTO user_notifications(donation_id, userID, message, notFrom) VALUES (?, ?, ?, ?)";
            $paramType = 'siss';
            $paramValue = array($id, $userID, $message, 'Blood_Bank');
            return $this->conn->insert($query, $paramType, $paramValue);
        } else {
            return "User not found";
        }
    }

    public function acceptReq($data)
    {
        $response = array();

        $query = 'SELECT * FROM blood_stock WHERE blood_group = ?';
        $paramType = 's';
        $paramValue = array($data['stock']['blood_group']);
        $result = $this->conn->select($query, $paramType, $paramValue);

        if (!empty($result)) {
            $updatedQuantity = $result[0]['quantity'] + $data['stock']['quantity'];
            $query = 'UPDATE blood_stock SET quantity = ? WHERE blood_group = ?';
            $paramType = 'ss';
            $paramValue = array($updatedQuantity, $data['stock']['blood_group']);
            $this->conn->update($query, $paramType, $paramValue);
        } else {
            $query = 'INSERT INTO blood_stock (stock_id, blood_group,quantity) VALUES(?,?,?)';
            $paramType = 'sss';
            $paramValue = array(
                $data['stock_id'],
                $data['stock']['blood_group'],
                $data['stock']['quantity'],
            );
            $this->conn->insert($query, $paramType, $paramValue);
        }

        $query = 'UPDATE blood_donation SET request_status = ? WHERE donation_id = ?';
        $paramType = 'ss';
        $paramValue = array('approved', $data['stock']['donation_id']);
        $updatedID = $this->conn->update($query, $paramType, $paramValue);

        if (!empty($updatedID)) {
            $notID = $this->createAdminNotification($data['stock']['donation_id']);
            if (!empty($notID)) {
                $response = array(
                    "status" => "success",
                    "message" => "Donation Request has been accepted."
                );
            } else {
                $response = array(
                    "status" => "error",
                    "message" => "Donation Request cannot be processed."
                );
            }
        }

        return $response;
    }

    public function rejectReq($donorID)
    {
        $query = "SELECT * FROM blood_donation WHERE donation_id = ?";
        $paramType = "s";
        $paramValue = array($donorID);
        $result = $this->conn->select($query, $paramType, $paramValue);

        if (!empty($result)) {
            $query = "DELETE FROM blood_donation WHERE donation_id = ?";
            $paramType = "s";
            $paramValue = array($donorID);
            $this->conn->delete($query, $paramType, $paramValue);
            $response = array(
                "status" => "success",
                "message" => "Record deleted successfully."
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Record not found."
            );
        }

        return $response;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data !== null) {
        $insertDonor = new BloodManagement;
        $response = $data['method'] === 'reject'
            ? $insertDonor->rejectReq($data['donation_id'])
            : $insertDonor->acceptReq($data);

        echo json_encode($response);
    } else {
        echo 'Error decoding JSON';
    }
}