<?php
include 'config.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

$sql = "SELECT * FROM employees WHERE id = $id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Record</title>
</head>
<body>

<h1>Employee Details</h1>

<?php if ($row): ?>
    <p>ID: <?php echo $row['id']; ?></p>
    <p>Name: <?php echo $row['name']; ?></p>
    <p>Address: <?php echo $row['address']; ?></p>
    <p>Salary: $<?php echo number_format($row['salary'], 2); ?></p>
<?php else: ?>
    <p>No record found.</p>
<?php endif; ?>

<a href="index.php">Back to Home</a>

<?php
mysqli_close($link);
?>

</body>
</html>
