<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$product_name = $brand_name = $size = $color = $price = "";
$product_name_err = $brand_name_err = $size_err = $color_err = $price_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate product name
    $input_product_name = trim($_POST["product_name"]);
    if (empty($input_product_name)) {
        $product_name_err = "Please enter the product name.";
    } else {
        $product_name = $input_product_name;
    }

    // Validate brand name
    $input_brand_name = trim($_POST["brand_name"]);
    if (empty($input_brand_name)) {
        $brand_name_err = "Please enter the brand name.";
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
    } elseif (!is_numeric($input_price) || $input_price < 0) {
        $price_err = "Please enter a valid positive number for price.";
    } else {
        $price = $input_price;
    }

    // Check input errors before inserting in database
    if (empty($product_name_err) && empty($brand_name_err) && empty($size_err) && empty($color_err) && empty($price_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, brand_name, size, color, price) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssd", $param_product_name, $param_brand_name, $param_size, $param_color, $param_price);

            // Set parameters
            $param_product_name = $product_name;
            $param_brand_name = $brand_name;
            $param_size = $size;
            $param_color = $color;
            $param_price = $price;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Product</h2>
                    <p>Please fill this form and submit to add a product to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control <?php echo (!empty($product_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $product_name; ?>">
                            <span class="invalid-feedback"><?php echo $product_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" class="form-control <?php echo (!empty($brand_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $brand_name; ?>">
                            <span class="invalid-feedback"><?php echo $brand_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control <?php echo (!empty($size_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $size; ?>">
                            <span class="invalid-feedback"><?php echo $size_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control <?php echo (!empty($color_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $color; ?>">
                            <span class="invalid-feedback"><?php echo $color_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                            <span class="invalid-feedback"><?php echo $price_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
