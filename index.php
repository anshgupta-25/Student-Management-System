<?php
require 'db.php';

$message = '';
$messageClass = '';
if (isset($_GET['status']) && isset($_GET['msg'])) {
    $messageClass = $_GET['status'] === 'success' ? 'success' : 'error';
    $message = htmlspecialchars($_GET['msg']);
}

$result = $conn->query('SELECT * FROM students ORDER BY id DESC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <h1>Student Management System</h1>
    <a class="btn" href="add.php">Add New Student</a>

    <?php if (!empty($message)): ?>
        <div class="message <?= $messageClass; ?>"> <?= $message; ?> </div>
    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Branch</th>
            <th>Year</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['roll_no']); ?></td>
                    <td><?= htmlspecialchars($row['branch']); ?></td>
                    <td><?= htmlspecialchars($row['year']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <a class="btn-action btn-edit" href="edit.php?id=<?= $row['id']; ?>">Edit</a>
                        <form method="POST" action="delete.php" style="display:inline" onsubmit="return confirmDeletion('<?= htmlspecialchars($row['name']); ?>');">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn-action btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No students found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="js/app.js"></script>
</body>
</html>
