<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <title>Register | Velonic - Bootstrap 5 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="authentication-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center mt-5">
                    <h1>🎉 Congratulations! You've successfully signed up</h1>
                    <p>You're now part of our community and can enjoy all the benefits of being a member.</p>
                    <p>You are now registered as <?php echo $_SESSION['name']; ?>.</p>
                    <p>Click below to proceed to sign in:</p>
                    <a href="admin.php" class="btn btn-primary fw-semibold">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
