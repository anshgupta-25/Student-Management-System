<?php
header('Content-Type: application/json; charset=utf-8');

require 'db.php';

$response = [
    'success' => true,
    'count' => 0,
    'students' => []
];

try {
    $sql = 'SELECT id, name, roll_no, branch, year, email, created_at FROM students ORDER BY id DESC';
    $result = $conn->query($sql);

    if ($result === false) {
        throw new Exception('Query failed.');
    }

    while ($row = $result->fetch_assoc()) {
        $response['students'][] = $row;
    }

    $response['count'] = count($response['students']);
} catch (Throwable $th) {
    http_response_code(500);
    $response['success'] = false;
    $response['error'] = $th->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
