<?php

// use DataSource\DataSource;
use DataSource\DataSource;

require_once __DIR__ . '/../lib/DataSource.php';

$con = new DataSource;
$query = 'SELECT blood_group, SUM(quantity) AS total_quantity FROM blood_stock GROUP BY blood_group';
$paramType = '';
$paramArray = array();
$stocks = $con->select($query, $paramType, $paramArray);

$data = array();
if (!empty($stocks)) {
    foreach ($stocks as $stock) {
        $data[] = array(
            'blood_group' => $stock['blood_group'],
            'total_quantity' => (int) $stock['total_quantity']
        );
    }
}

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>