<?php
include 'config.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $salary = mysqli_real_escape_string($link, $_POST['salary']);

    $sql = "UPDATE employees SET name = '$name', address = '$address', salary = '$salary' WHERE id = $id";
    if (mysqli_query($link, $sql)) {
        header("Location: index.php");
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
} else {
    $sql = "SELECT * FROM employees WHERE id = $id";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record</title>
</head>
<body>

<h1>Update Employee Record</h1>
<form action="update.php?id=<?php echo $id; ?>" method="post">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
    Address: <input type="text" name="address" value="<?php echo $row['address']; ?>" required><br>
    Salary: <input type="number" step="0.01" name="salary" value="<?php echo $row['salary']; ?>" required><br>
    <input type="submit" value="Update">
</form>

<a href="index.php">Back to Home</a>

<?php
mysqli_close($link);
?>

</body>
</html>
