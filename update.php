<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$product_name = $brand_name = $size = $color = $price = "";
$product_name_err = $brand_name_err = $size_err = $color_err = $price_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

    // Validate product name
    $input_product_name = trim($_POST["product_name"]);
    if (empty($input_product_name)) {
        $product_name_err = "Please enter a product name.";
    } else {
        $product_name = $input_product_name;
    }

    // Validate brand name
    $input_brand_name = trim($_POST["brand_name"]);
    if (empty($input_brand_name)) {
        $brand_name_err = "Please enter a brand name.";
    } else {
        $brand_name = $input_brand_name;
    }

    // Validate size
    $input_size = trim($_POST["size"]);
    if (empty($input_size)) {
        $size_err = "Please enter the size.";
    } else {
        $size = $input_size;
    }

    // Validate color
    $input_color = trim($_POST["color"]);
    if (empty($input_color)) {
        $color_err = "Please enter the color.";
    } else {
        $color = $input_color;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if (empty($input_price)) {
        $price_err = "Please enter the price.";
    } elseif (!is_numeric($input_price)) {
        $price_err = "Please enter a valid price.";
    } else {
        $price = $input_price;
    }

    // Check input errors before updating in database
    if (empty($product_name_err) && empty($brand_name_err) && empty($size_err) && empty($color_err) && empty($price_err)) {
        // Prepare an update statement
        $sql = "UPDATE products SET product_name=?, brand_name=?, size=?, color=?, price=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssdi", $param_product_name, $param_brand_name, $param_size, $param_color, $param_price, $param_id);

            // Set parameters
            $param_product_name = $product_name;
            $param_brand_name = $brand_name;
            $param_size = $size;
            $param_color = $color;
            $param_price = $price;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM products WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    // Fetch result row as an associative array
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field values
                    $product_name = $row["product_name"];
                    $brand_name = $row["brand_name"];
                    $size = $row["size"];
                    $color = $row["color"];
                    $price = $row["price"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
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
    <title>Update Product Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    <h2 class="mt-5">Update Product Record</h2>
                    <p>Please edit the input values and submit to update the product record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($product_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($product_name); ?>">
                            <span class="invalid-feedback"><?php echo $product_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" class="form-control <?php echo (!empty($brand_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($brand_name); ?>">
                            <span class="invalid-feedback"><?php echo $brand_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control <?php echo (!empty($size_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($size); ?>">
                            <span class="invalid-feedback"><?php echo $size_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($color); ?>">
                            <span class="invalid-feedback"><?php echo $color_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($price); ?>">
                            <span class="invalid-feedback"><?php echo $price_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
