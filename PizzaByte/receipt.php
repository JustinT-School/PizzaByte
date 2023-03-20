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
    ?>

    <header>
        <div class="d-flex flex-row justify-content-around m-5">
            <img src="images/logo.png" class="img-fluid w-25" alt="Pizza Byte">
            <h1 class="d-flex text-center display-1 align-items-center">Online Ordering Form</h1>
            <img src="images/delivery.png" class="img-fluid w-25" alt="Delivery">
        </div>
    </header>
    
    <hr class="hr ml-5 mr-5 bg-dark" />

    <div class="container border border-dark p-2">
        <h1>Receipt</h1>
        <hr class="hr ml-2 mr-2 bg-dark" />
        <h4>Customer Information</h4>
        <p>Name: <?php echo $_SESSION['firstName']; echo " "; echo $_SESSION['lastName'];?></p>
        <p>Address: <?php  echo $_SESSION['deliveryLocation'];?></p>
        <p>Phone #: <?php echo $_SESSION['customerPhone'];?></p>
        <hr class="hr ml-2 mr-2 bg-dark" />
        <h4>Pizza Information</h4>
        <p>Size: <?php echo $_SESSION['pizzaSize'];?></p>
        <p>Crust: <?php echo $_SESSION['crust'];?></p>
        <p>Quantity: <?php echo $_SESSION['quantity'];?></p>
        <p>Special Instructions: <?php echo $_SESSION['special_instructions'];?></p>
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