<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $salary = mysqli_real_escape_string($link, $_POST['salary']);

    $sql = "INSERT INTO employees (name, address, salary) VALUES ('$name', '$address', '$salary')";
    if (mysqli_query($link, $sql)) {
        header("Location: index.php");
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Record</title>
</head>
<body>

<h1>Create New Employee Record</h1>
<form action="create.php" method="post">
    Name: <input type="text" name="name" required><br>
    Address: <input type="text" name="address" required><br>
    Salary: <input type="number" step="0.01" name="salary" required><br>
    <input type="submit" value="Create">
</form>

<a href="index.php">Back to Home</a>

</body>
</html>
