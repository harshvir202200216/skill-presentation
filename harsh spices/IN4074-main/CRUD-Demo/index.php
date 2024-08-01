<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spice Shop Dashboard and Deals</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index css/index css.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }

        .video-background {
            position: relative;
            overflow: hidden;
        }

        .video-background video {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
        }

        .header a {
            margin: 0 15px;
            color: #fff;
            text-decoration: none;
        }

        .search-bar {
            margin: 20px 0;
        }

        .categories ul, .item-list ul {
            list-style: none;
            padding: 0;
        }

        .categories li, .item-list li {
            margin-bottom: 10px;
        }

        .item-image {
            width: 100px;
            height: auto;
        }

        .item-info {
            display: inline-block;
            vertical-align: top;
            margin-left: 10px;
        }

        .btn-buy {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .footer-section {
            width: 30%;
        }

        .footer-bottom {
            text-align: center;
            padding: 10px 0;
        }

        .social-links {
            list-style: none;
            padding: 0;
        }

        .social-links li {
            display: inline;
            margin-right: 10px;
        }

        .social-links a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="video-background">
        <video autoplay loop muted>
            <source src="video/video.mp4" type="video/mp4">
        </video>
    </div>

    <header class="header">
        <a href="config.php">Sales Details</a>
        <a href="sign in and register.html">Sign in or register</a>
        <a href="best deals.html">Best Deals</a>
        <a href="help and contact.html">Help & Contact</a>
    </header>

    <div class="search-bar">
        <input type="search" placeholder="Search for spices">
        <button type="submit">Search</button>
    </div>

    <nav class="categories">
        <ul>
            <li><a href="home-garden.html">Home & Garden</a></li>
            <li><a href="food-beverages.html">Food & Beverages</a></li>
            <li><a href="non-alcoholic-drinks.html">Non-Alcoholic Drinks</a></li>
            <li><a href="tea-infusions.html">Tea & Infusions</a></li>
        </ul>
    </nav>

    <section class="item-list">
        <!-- Items listed here as before -->
        <ul>
            <li>
                <img src="images/turmeric powder.jpg" alt="Turmeric" class="item-image">
                <div class="item-info">
                    <h2 class="item-title">Turmeric Powder</h2>
                    <p class="item-price">$5.99 <span>Free shipping</span></p>
                    <p class="item-description">Turmeric is known for its vibrant color and earthy flavor. It is widely used in Indian cuisine for curries, rice dishes, and soups. It also has medicinal properties.</p>
                    <p class="item-uses">Uses: Curries, Rice, Soups, Health Tonics</p>
                    <p class="item-ingredients">Ingredients: 100% Ground Turmeric</p>
                    <a href="buy.html" class="btn-buy">Click here to buy</a>
                </div>
            </li>
            <!-- Add other items similarly -->
        </ul>
    </section>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM employees";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Address</th>";
                            echo "<th>Salary</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Shop with Confidence</h3>
                <p>At Spicely, we ensure your spice journey is nothing short of extraordinary. With our commitment to quality and customer satisfaction, you can shop with confidence.</p>
            </div>
            <div class="footer-section">
                <h3>About Spicely</h3>
                <p>Spicely is your ultimate destination for premium quality spices sourced from around the globe. Our passion for flavors and dedication to authenticity make us your trusted spice partner.</p>
            </div>
            <div class="footer-section">
                <h3>Stay Connected</h3>
                <p>Follow us on social media for the latest updates, recipes, and exclusive offers:</p>
                <ul class="social-links">
                    <li><a href="#" target="_blank">Facebook</a></li>
                    <li><a href="#" target="_blank">Twitter</a></li>
                    <li><a href="#" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Spicely. All rights reserved.</p>
            <p>Contact us: Harshvir Singh (Student ID: 202200216) | Email: w23.harshvir227.northern@purescollege.ca</p>
        </div>
    </footer>
</body>

</html>
