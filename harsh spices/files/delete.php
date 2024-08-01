<?php
include 'config.php';

$id = mysqli_real_escape_string($link, $_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $confirm = $_POST['confirm'];

    if ($confirm == 'Yes') {
        $sql = "DELETE FROM employees WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            header("Location: index.php");
        } else {
            echo "ERROR: Could not execute $sql. " . mysqli_error($link);
        }
    } else {
        header("Location: index.php");
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
</head>
<body>

<h1>Confirm Deletion</h1>
<form action="delete.php?id=<?php echo $id; ?>" method="post">
    <p>Are you sure you want to delete this record?</p>
    <input type="radio" name="confirm" value="Yes" required> Yes
    <input type="radio" name="confirm" value="No" required> No<br>
    <input type="submit" value="Submit">
</form>

<a href="index.php">Back to Home</a>

</body>
</html>
