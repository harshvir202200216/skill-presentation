<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$spice_name = $spice_price = $spice_sold_amount = $last_sale_amount = $total_amount = $spice_sale_decreased = "";
$spice_name_err = $spice_price_err = $spice_sold_amount_err = $last_sale_amount_err = $total_amount_err = $spice_sale_decreased_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate spice name
    $input_spice_name = trim($_POST["spice_name"]);
    if(empty($input_spice_name)){
        $spice_name_err = "Please enter the spice name.";
    } else{
        $spice_name = $input_spice_name;
    }
    
    // Validate spice price
    $input_spice_price = trim($_POST["spice_price"]);
    if(empty($input_spice_price)){
        $spice_price_err = "Please enter the spice price.";
    } elseif(!ctype_digit($input_spice_price)){
        $spice_price_err = "Please enter a positive integer value.";
    } else{
        $spice_price = $input_spice_price;
    }
    
    // Validate spice sold amount
    $input_spice_sold_amount = trim($_POST["spice_sold_amount"]);
    if(empty($input_spice_sold_amount)){
        $spice_sold_amount_err = "Please enter the spice sold amount.";
    } else{
        $spice_sold_amount = $input_spice_sold_amount;
    }
    
    // Validate last sale amount
    $input_last_sale_amount = trim($_POST["last_sale_amount"]);
    if(empty($input_last_sale_amount)){
        $last_sale_amount_err = "Please enter the last sale amount.";
    } else{
        $last_sale_amount = $input_last_sale_amount;
    }
    
    // Validate total amount
    $input_total_amount = trim($_POST["total_amount"]);
    if(empty($input_total_amount)){
        $total_amount_err = "Please enter the total amount.";
    } else{
        $total_amount = $input_total_amount;
    }
    
    // Validate spice sale decreased
    $input_spice_sale_decreased = trim($_POST["spice_sale_decreased"]);
    if(empty($input_spice_sale_decreased)){
        $spice_sale_decreased_err = "Please enter the spice sale decreased amount.";
    } else{
        $spice_sale_decreased = $input_spice_sale_decreased;
    }
    
    // Check input errors before inserting in database
    if(empty($spice_name_err) && empty($spice_price_err) && empty($spice_sold_amount_err) && empty($last_sale_amount_err) && empty($total_amount_err) && empty($spice_sale_decreased_err)){
        // Prepare an update statement
        $sql = "UPDATE spices SET spice_name=?, spice_price=?, spice_sold_amount=?, last_sale_amount=?, total_amount=?, spice_sale_decreased=? WHERE id=?";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssissii", $spice_name, $spice_price, $spice_sold_amount, $last_sale_amount, $total_amount, $spice_sale_decreased, $id);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index1.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM spices WHERE id = ?";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
    
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $spice_name = $row["spice_name"];
                    $spice_price = $row["spice_price"];
                    $spice_sold_amount = $row["spice_sold_amount"];
                    $last_sale_amount = $row["last_sale_amount"];
                    $total_amount = $row["total_amount"];
                    $spice_sale_decreased = $row["spice_sale_decreased"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
        // Close connection
        $conn->close();
    } else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Spice Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
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
                    <h2 class="mt-5">Update Spice Record</h2>
                    <p>Please edit the input values and submit to update the spice record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index1.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
