<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php?status=error&msg=' . urlencode('Student ID missing.'));
    exit;
}

$id = (int) $_GET['id'];
$message = '';
$messageClass = '';

$stmt = $conn->prepare('SELECT * FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $stmt->close();
    header('Location: index.php?status=error&msg=' . urlencode('Student not found.'));
    exit;
}

$student = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $branch = trim($_POST['branch']);
    $year = trim($_POST['year']);
    $email = trim($_POST['email']);

    if ($name && $roll_no && $branch && $year && $email) {
        try {
            $stmt = $conn->prepare('UPDATE students SET name = ?, roll_no = ?, branch = ?, year = ?, email = ? WHERE id = ?');
            $stmt->bind_param('sssssi', $name, $roll_no, $branch, $year, $email, $id);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?status=success&msg=' . urlencode('Student updated successfully.'));
            exit;
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $message = 'Duplicate roll number or email. Please use unique values.';
            } else {
                $message = 'Error updating student. Please try again.';
            }
            $messageClass = 'error';
        }
    } else {
        $message = 'All fields are required.';
        $messageClass = 'error';
    }
} else {
    $name = $student['name'];
    $roll_no = $student['roll_no'];
    $branch = $student['branch'];
    $year = $student['year'];
    $email = $student['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Edit Student</h1>
    <a class="btn" href="index.php">Back to Students</a>

    <?php if (!empty($message)): ?>
        <div class="message <?= $messageClass; ?>"> <?= $message; ?> </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($name); ?>" required>
        </div>
        <div>
            <label>Roll No</label>
            <input type="text" name="roll_no" value="<?= htmlspecialchars($roll_no); ?>" required>
        </div>
        <div>
            <label>Branch</label>
            <input type="text" name="branch" value="<?= htmlspecialchars($branch); ?>" required>
        </div>
        <div>
            <label>Year</label>
            <input type="text" name="year" value="<?= htmlspecialchars($year); ?>" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
        </div>
        <button type="submit">Update Student</button>
    </form>
</div>
</body>
</html>
