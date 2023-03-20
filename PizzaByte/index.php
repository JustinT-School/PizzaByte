<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Icon -->
    <link rel="icon" href="images/icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">

    <title>Pizza Byte</title>
</head>
<body>
    <?php
        session_start();

        // Empty error variables
        $fnameErr = "";
        $lnameErr = "";
        $dlErr = "";
        $cpErr = "";
        $psErr = "";
        $crustErr = "";

        // Required class variables
        $fnRequired = "text-muted";
        $lnRequired = "text-muted";
        $dlRequired = "text-muted";
        $cpRequired = "text-muted";
        $psRequired = "text-muted";
        $crustRequired = "text-muted";

        // Required fields are valid
        $fnValid = FALSE;
        $lnValid = FALSE;
        $dlValid = FALSE;
        $cpValid = FALSE;
        $psValid = FALSE;
        $crustValid = FALSE;

        // Empty input variables
        $_SESSION['firstName'] = "";
        $_SESSION['lastName'] = "";
        $_SESSION['deliveryLocation'] = "";
        $_SESSION['customerPhone'] = "";
        $_SESSION['pizzaSize'] = $_POST['pizza_size'];
        $_SESSION['crust'] = $_POST['crust'];

        // Non-required variables
        $_SESSION['quantity'] = $_POST['quantity'];
        $_SESSION['special_instructions'] = $_POST['special_instructions'];

        // Check input data and output any errors
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['first_name'])) {
                $fnameErr = "First name is required.";
                $fnRequired = "text-danger";
                $fnValid = FALSE;
            } else {
                $_SESSION['firstName'] = validate($_POST['first_name']);

                if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['firstName'])) {
                    $fnameErr = "Only letters and white space allowed"; 
                    $fnRequired = "text-danger";
                    $_SESSION['firstName'] = "";
                    $fnValid = FALSE;
                } else {
                    $_SESSION['firstName'] = validate($_POST['first_name']);
                    $fnRequired = "text-muted";
                    $fnValid = TRUE;
                }
            }

            if (empty($_POST['last_name'])) {
                $lnameErr = "Last name is required.";
                $lnRequired = "text-danger";
                $lnValid = FALSE;
            } else {
                $_SESSION['lastName'] = validate($_POST['last_name']);

                if (!preg_match("/^[a-zA-Z-' ]*$/",$_SESSION['lastName'])) {
                    $lnameErr = "Only letters and white space allowed"; 
                    $lnRequired = "text-danger";
                    $_SESSION['lastName'] = "";
                    $lnValid = FALSE;
                } else {
                    $_SESSION['lastName'] = validate($_POST['last_name']);
                    $lnRequired = "text-muted";
                    $lnValid = TRUE;
                }
            }

            if (empty($_POST['delivery_location'])) {
                $dlErr = "Delivery location is required.";
                $dlRequired = "text-danger";
                $dlValid = FALSE;
            } else {
                $_SESSION['deliveryLocation'] = validate($_POST['delivery_location']);
                $dlRequired = "text-muted";
                $dlValid = TRUE;
            }

            if (empty($_POST['customer_phone'])) {
                $cpErr = "Phone number is required.";
                $cpRequired = "text-danger";
                $cpValid = FALSE;
            } else {
                $_SESSION['customerPhone'] = validate($_POST['customer_phone']);

                if (!is_numeric($_SESSION['customerPhone'])) {
                    $cpErr = "Only numbers allowed."; 
                    $cpRequired = "text-danger";
                    $_SESSION['customerPhone'] = "";
                    $cpValid = FALSE;
                } else {
                    $_SESSION['customerPhone'] = validate($_POST['customer_phone']);
                    $cpRequired = "text-muted";
                    $cpValid = TRUE;
                }
            }

            if (empty($_SESSION['pizzaSize'])) {
                $psErr = "Pizza size is required.";
                $psRequired = "text-danger";
                $psValid = FALSE;
            } else {
                $_SESSION['pizzaSize'] = validate($_POST['pizza_size']);
                switch ($_SESSION['pizzaSize']) {
                    case 'ten':
                        $_SESSION['pizzaSize'] = "10 in.";
                        break;
                    case 'twelve':
                        $_SESSION['pizzaSize'] = "12 in.";
                        break;
                    case 'fourteen':
                        $_SESSION['pizzaSize'] = "14 in.";
                        break;
                    
                    default:
                        $_SESSION['pizzaSize'] = "10 in.";
                        break;
                }
                $psValid = TRUE;
            }
            
            if (empty($_SESSION['crust'])) {
                $crustErr = "Crust type is required.";
                $crustRequired = "text-danger";
                $crustValid = FALSE;
            } else {
                $_SESSION['crust'] = validate($_POST['crust']);
                switch ($_SESSION['crust']) {
                    case 'thin':
                        $_SESSION['crust'] = "Thin";
                        break;
                    case 'regular':
                        $_SESSION['crust'] = "Regular";
                        break;
                    case 'thick':
                        $_SESSION['crust'] = "Thick";
                        break;
                    default:
                        $_SESSION['crust'] = "Thin";
                        break;
                }
                $crustValid = TRUE;
            }

        }

        if ($fnValid && $lnValid && $dlValid && $cpValid && $psValid && $crustValid) {
            header("Location: receipt.php");
        }

        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <header>
        <div class="d-flex flex-row justify-content-around m-5">
            <img src="images/logo.png" class="img-fluid w-25" alt="Pizza Byte">
            <h1 class="d-flex text-center display-1 align-items-center">Online Ordering Form</h1>
            <img src="images/delivery.png" class="img-fluid w-25" alt="Delivery">
        </div>
    </header>
    
    <hr class="hr ml-5 mr-5 bg-dark" />

    <div class="container-fluid">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <div class="ml-5 mr-5">
                <p>Required values are marked by an asterisk (*)</p>
            </div>
            <div class="row pl-5 pr-5 pt-2 pb-2">
                <div class="col-lg-4 col-md-12 mb-5">
                    <div class="border border-dark p-2">
                        <p>Customer Information</p>
                        <div class="form-group">
                            <div class="col-auto">
                                <!-- First Name -->
                                <label for="first_name">First Name: <span class="<?php echo $fnRequired;?>">*</span> <span class="text-danger"><?php echo $fnameErr;?></span></label>
                                <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $_SESSION['firstName'];?>">

                                <!-- Last Name -->
                                <label for="last_name" class="pt-2">Last Name: <span class="<?php echo $lnRequired;?>">*</span> <span class="text-danger"><?php echo $lnameErr;?></span></label>
                                <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $_SESSION['lastName'];?>">

                                <!-- Delivery Location -->
                                <label for="delivery_location" class="pt-2">Delivery Location: <span class="<?php echo $dlRequired?>">*</span> <span class="text-danger"><?php echo $dlErr;?></span></label>
                                <input type="text" id="delivery_location" name="delivery_location" class="form-control" value="<?php echo $_SESSION['deliveryLocation'];?>">

                                <!-- Customer Phone -->
                                <label for="customer_phone" class="pt-2">Phone Number: <span class="<?php echo $cpRequired;?>">*</span> <span class="text-danger"><?php echo $cpErr;?></span></label>
                                <input type="tel" id="customer_phone" name="customer_phone" class="form-control" value="<?php echo $_SESSION['customerPhone'];?>">

                                <!-- Delivery Time -->
                                <label for="delivery_time" class="pt-2">Delivery Time:</label>
                                <input type="time" id="delivery_time" name="delivery_time" class="form-control" aria_describedby="dt_help">
                                <small id="dt_help" class="form-text text-muted pl-2">
                                    Leave blank for immediate delivery.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="border border-dark p-2">
                        <p>Customize Your Pizza</p>
                        <div class="form-group">
                            <div class="col-auto">
                                <label for="pizza_size" class="pt-2">Select your Pizza Size: <span class="<?php echo $psRequired?>">*</span> <span class="text-danger"><?php echo $psErr;?></span></label>
                                <select name="pizza_size" id="pizza_size" class="form-control">
                                    <option selected disabled value="default">Choose...</option>
                                    <option value="ten">10 Inch</option>
                                    <option value="twelve">12 Inch</option>
                                    <option value="fourteen">14 Inch</option>
                                </select>
                                <label for="crust" class="pt-2">Choose your crust: <span class="<?php echo $crustRequired?>">*</span> <span class="text-danger"><?php echo $crustErr;?></span></label>
                                <select name="crust" id="crust" class="form-control">
                                    <option selected disabled value="default">Choose...</option>
                                    <option value="thin">Thin</option>
                                    <option value="regular">Regular</option>
                                    <option value="thick">Thick</option>
                                </select>
                                <label for="quantity" class="pt-2">Quantity:</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" value="1">
                                <small id="qt_help" class="form-text text-muted pl-2">
                                    Call for quantities larger than 10.
                                </small>
                                <label for="special_instructions" class="pt-2">Special Instructions:</label>
                                <textarea id="special_instructions" name="special_instructions" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="toppings">Toppings:</label>
                            <div class="row">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input type="checkbox" id="pepperoni" name="pepperoni" class="form-check-input" value="pepperoni">
                                        <label for="pepperoni" class="form-check-label">Pepperoni</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="ham" name="ham" class="form-check-input" value="ham">
                                        <label for="ham" class="form-check-label">Ham</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="pork" name="pork" class="form-check-input" value="pork">
                                        <label for="pork" class="form-check-label">Pork</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="sausage" name="sausage" class="form-check-input" value="sausage">
                                        <label for="sausage" class="form-check-label">Sausage</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="chicken" name="chicken" class="form-check-input" value="chicken">
                                        <label for="chicken" class="form-check-label">Chicken</label>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input type="checkbox" id="mushrooms" name="mushrooms" class="form-check-input" value="mushrooms">
                                        <label for="mushrooms" class="form-check-label">Mushrooms</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="green_peppers" name="green_peppers" class="form-check-input" value="green_peppers">
                                        <label for="green_peppers" class="form-check-label">Green Peppers</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="onions" name="onions" class="form-check-input" value="onions">
                                        <label for="onions" class="form-check-label">Onions</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="tomatoes" name="tomatoes" class="form-check-input" value="tomatoes">
                                        <label for="tomatoes" class="form-check-label">Tomatoes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="jalapenos" name="jalapenos" class="form-check-input" value="jalapenos">
                                        <label for="jalapenos" class="form-check-label">Jalapenos</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="extras">Extras:</label>
                            <div class="col-auto">
                                    <div class="form-check">
                                        <input type="checkbox" id="double_cheese" name="ham" class="form-check-input" value="double_cheese">
                                        <label for="double_cheese" class="form-check-label">Double Cheese</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="double_sauce" name="ham" class="form-check-input" value="double_sauce">
                                        <label for="double_sauce" class="form-check-label">Double Sauce</label>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-3">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg align-center">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-2 mr-5 ml-5 mb-2 d-flex justify-content-center">
        <p class="text-justify-center">Thank you for using our <i>online ordering</i> form for quick and easy orders, delivered free, fast, and hot to your door. 
            If you need to talk to us directly, call Pizza Byte at (302) 555-7599.</p>
    </div>

    <hr class="hr ml-5 mr-5 bg-dark" />

    <footer class="ml-5 mr-5">
        <p class="text-center">Pizza Byte &bull; 123 Market Street &bull; Milltown, DE 19900 &bull; (302) 555-7599</p>
    </footer>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
</body>
</html>