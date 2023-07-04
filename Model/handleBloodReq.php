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
        $query = "INSERT INTO user_notifications (donation_id, userID, message, notFrom) VALUES (?, ?, ?, ?)";
        $paramType = 'siss';
        $paramValue = array($id, $userID, $message, 'Blood_Bank');

        $insertedID = $this->conn->insert($query, $paramType, $paramValue);
        if (!empty($insertedID)) {
            return $insertedID;
        } else {
            return "Failed to insert notification data.";
        }
    } else {
        return "User not found";
    }
}

    public function acceptReq($request_id, $blood_group, $quantity, $request_status)
    {
        $query = 'SELECT * FROM blood_stock WHERE blood_group = ? AND quantity >= ?';
        $paramType = 'ss';
        $paramValue = array($blood_group, $quantity);
        $result = $this->conn->select($query, $paramType, $paramValue);

        if (empty($result)) {
            return array(
                "status" => "error",
                "message" => "Not enough stock available for $blood_group blood type."
            );
        }

        $updatedQuantity = $result[0]['quantity'] - $quantity;
        $query = 'UPDATE blood_stock SET quantity = ? WHERE blood_group = ?';
        $paramType = 'ss';
        $paramValue = array($updatedQuantity, $blood_group);
        $this->conn->update($query, $paramType, $paramValue);

        $query = 'UPDATE blood_requests SET request_status = ? WHERE request_id = ?';
        $paramType = 'ss';
        $paramValue = array($request_status, $request_id);
        $updatedRows = $this->conn->update($query, $paramType, $paramValue);

        if ($updatedRows === false) {
            return array(
                "status" => "error",
                "message" => "Failed to update request status."
            );
        }

        $notificationID = $this->createAdminNotification($request_id);

        if (!empty($notificationID)) {
            return array(
                "status" => "success",
                "message" => "Blood request has been accepted."
            );
        } else {
            return array(
                "status" => "error",
                "message" => "Failed to create admin notification."
            );
        }
    }

    public function rejectReq($request_id)
    {
        $query = "SELECT * FROM blood_requests WHERE request_id = ?";
        $paramType = "s";
        $paramValue = array($request_id);
        $result = $this->conn->select($query, $paramType, $paramValue);

        if (!empty($result)) {
            $query = "DELETE FROM blood_requests WHERE request_id = ?";
            $paramType = "s";
            $paramValue = array($request_id);
            $this->conn->delete($query, $paramType, $paramValue);

            return array(
                "status" => "success",
                "message" => "Record deleted successfully."
            );
        } else {
            return array(
                "status" => "error",
                "message" => "Record not found."
            );
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $handleReq = new BloodManagement;

    if ($data['method'] === 'reject') {
        $response = $handleReq->rejectReq($data['request_id']);
    } elseif ($data['method'] === 'accept') {
        $response = $handleReq->acceptReq(
            $data['request_id'],
            $data['blood_group'],
            $data['quantity'],
            $data['request_status']
        );
    } else {
        $response = array(
            "status" => "error",
            "message" => "Invalid method."
        );
    }

    echo json_encode($response);
}
