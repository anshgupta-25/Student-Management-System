<?php
require 'db.php';

$name = $roll_no = $branch = $year = $email = '';
$message = '';
$messageClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $roll_no = trim($_POST['roll_no']);
    $branch = trim($_POST['branch']);
    $year = trim($_POST['year']);
    $email = trim($_POST['email']);

    if ($name && $roll_no && $branch && $year && $email) {
        try {
            $stmt = $conn->prepare('INSERT INTO students (name, roll_no, branch, year, email) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $name, $roll_no, $branch, $year, $email);
            $stmt->execute();
            $stmt->close();

            header('Location: index.php?status=success&msg=' . urlencode('Student added successfully.'));
            exit;
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $message = 'Duplicate roll number or email. Please use unique values.';
            } else {
                $message = 'Error adding student. Please try again.';
            }
            $messageClass = 'error';
        }
    } else {
        $message = 'All fields are required.';
        $messageClass = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Add Student</h1>
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
        <button type="submit">Save Student</button>
    </form>
</div>
</body>
</html>
