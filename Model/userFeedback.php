<?php

use DataSource\DataSource;

class FeedbackModel
{
    private $conn;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }

    function getFeedbackData()
    {
        $query = 'SELECT FeedbackID, email, username, phone, FeedbackText, FeedbackDate
                  FROM Feedback';

        $feedbackData = $this->conn->select($query);

        return $feedbackData;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $feedbackModel = new FeedbackModel();
    $feedbackData = $feedbackModel->getFeedbackData();

    // Output the response as JSON
    header('Content-Type: application/json');
    echo json_encode($feedbackData);
}
?>
