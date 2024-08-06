<?php
include 'config.php';

// Define variables and initialize with empty values
$spice_name = $spice_price = $spice_sold_amount = $last_sale_amount = $total_amount = $spice_sale_decreased = "";
$spice_name_err = $spice_price_err = $spice_sold_amount_err = $last_sale_amount_err = $total_amount_err = $spice_sale_decreased_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate spice name
    $input_spice_name = trim($_POST["spice_name"]);
    if (empty($input_spice_name)) {
        $spice_name_err = "Please enter a spice name.";
    } else {
        $spice_name = $input_spice_name;
    }

    // Validate spice price
    $input_spice_price = trim($_POST["spice_price"]);
    if (empty($input_spice_price)) {
        $spice_price_err = "Please enter the price of the spice.";
    } elseif (!ctype_digit($input_spice_price) && !is_numeric($input_spice_price)) {
        $spice_price_err = "Please enter a valid number.";
    } else {
        $spice_price = $input_spice_price;
    }

    // Validate spice sold amount
    $input_spice_sold_amount = trim($_POST["spice_sold_amount"]);
    if (empty($input_spice_sold_amount)) {
        $spice_sold_amount_err = "Please enter the amount of spice sold.";
    } elseif (!ctype_digit($input_spice_sold_amount)) {
        $spice_sold_amount_err = "Please enter a valid integer value.";
    } else {
        $spice_sold_amount = $input_spice_sold_amount;
    }

    // Validate last sale amount
    $input_last_sale_amount = trim($_POST["last_sale_amount"]);
    if (empty($input_last_sale_amount)) {
        $last_sale_amount_err = "Please enter the last sale amount.";
    } elseif (!ctype_digit($input_last_sale_amount) && !is_numeric($input_last_sale_amount)) {
        $last_sale_amount_err = "Please enter a valid number.";
    } else {
        $last_sale_amount = $input_last_sale_amount;
    }

    // Validate total amount
    $input_total_amount = trim($_POST["total_amount"]);
    if (empty($input_total_amount)) {
        $total_amount_err = "Please enter the total amount.";
    } elseif (!ctype_digit($input_total_amount) && !is_numeric($input_total_amount)) {
        $total_amount_err = "Please enter a valid number.";
    } else {
        $total_amount = $input_total_amount;
    }

    // Validate spice sale decreased
    $input_spice_sale_decreased = trim($_POST["spice_sale_decreased"]);
    if (empty($input_spice_sale_decreased)) {
        $spice_sale_decreased_err = "Please enter the amount the spice sale decreased.";
    } elseif (!ctype_digit($input_spice_sale_decreased) && !is_numeric($input_spice_sale_decreased)) {
        $spice_sale_decreased_err = "Please enter a valid number.";
    } else {
        $spice_sale_decreased = $input_spice_sale_decreased;
    }

    // Check input errors before inserting in database
    if (empty($spice_name_err) && empty($spice_price_err) && empty($spice_sold_amount_err) && empty($last_sale_amount_err) && empty($total_amount_err) && empty($spice_sale_decreased_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO spices (spice_name, spice_price, spice_sold_amount, last_sale_amount, total_amount, spice_sale_decreased) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sddddi", $spice_name, $spice_price, $spice_sold_amount, $last_sale_amount, $total_amount, $spice_sale_decreased);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!-- HTML form to add a new spice -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Spice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Spice</h2>
                    <p>Please fill this form and submit to add a spice record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Spice Name</label>
                            <input type="text" name="spice_name" class="form-control <?php echo (!empty($spice_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spice_name; ?>">
                            <span class="invalid-feedback"><?php echo $spice_name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Spice Price</label>
                            <input type="text" name="spice_price" class="form-control <?php echo (!empty($spice_price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spice_price; ?>">
                            <span class="invalid-feedback"><?php echo $spice_price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Spice Sold Amount</label>
                            <input type="text" name="spice_sold_amount" class="form-control <?php echo (!empty($spice_sold_amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spice_sold_amount; ?>">
                            <span class="invalid-feedback"><?php echo $spice_sold_amount_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Sale Amount</label>
                            <input type="text" name="last_sale_amount" class="form-control <?php echo (!empty($last_sale_amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_sale_amount; ?>">
                            <span class="invalid-feedback"><?php echo $last_sale_amount_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Total Amount</label>
                            <input type="text" name="total_amount" class="form-control <?php echo (!empty($total_amount_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $total_amount; ?>">
                            <span class="invalid-feedback"><?php echo $total_amount_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Spice Sale Decreased</label>
                            <input type="text" name="spice_sale_decreased" class="form-control <?php echo (!empty($spice_sale_decreased_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spice_sale_decreased; ?>">
                            <span class="invalid-feedback"><?php echo $spice_sale_decreased_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Add Spice">
                        
                        <p><a href="index1.php" class="btn btn-primary">Main menu</a></p>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
