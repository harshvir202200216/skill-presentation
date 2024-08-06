<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM spices WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Spice Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Spice Record</h1>
                    <div class="form-group">
                        <label>Spice Name</label>
                        <p><b><?php echo $spice_name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Spice Price</label>
                        <p><b><?php echo $spice_price; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Spice Sold Amount</label>
                        <p><b><?php echo $spice_sold_amount; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Last Sale Amount</label>
                        <p><b><?php echo $last_sale_amount; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Total Amount</label>
                        <p><b><?php echo $total_amount; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Spice Sale Decreased</label>
                        <p><b><?php echo $spice_sale_decreased; ?></b></p>
                    </div>
                    <p><a href="index1.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
