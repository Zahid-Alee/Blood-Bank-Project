<?php

use DataSource\DataSource;


class HandleFeedback
{
    private $conn;

    function __construct()
    {

        require_once __DIR__ . '/../lib/DataSource.php';
        $this->conn = new DataSource();
    }
    function insertFeedback($data)
    {
        $feedBackID = uniqid('feedback-');

        $query = "INSERT INTO  feedback (FeedbackID ,email,username,phone,FeedbackText) VALUE(?,?,?,?,?) ";
        $paramType = "issss";
        $paramValue = array($feedBackID, $data['email'], $data['username'], $data['phone'], $data['message']);
        $feedID = $this->conn->insert($query, $paramType, $paramValue);

        if (!empty($feedID)) {
            $response = array(
                "status" => "success",
                "message" => "Feedback added successfully."
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "There was and error inserting Feedback."
            );
        }

        return $response;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    print_r($data);
    $feed = new HandleFeedback;
    $response = $feed->insertFeedback($data);

    echo json_encode($response);
}