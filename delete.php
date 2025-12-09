<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header('Location: index.php?status=error&msg=' . urlencode('Invalid delete request.'));
    exit;
}

$id = (int) $_POST['id'];

$stmt = $conn->prepare('DELETE FROM students WHERE id = ?');
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header('Location: index.php?status=success&msg=' . urlencode('Student deleted successfully.'));
} else {
    header('Location: index.php?status=error&msg=' . urlencode('Error deleting student.'));
}

$stmt->close();
exit;
?>
