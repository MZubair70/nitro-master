<?php
require "include/db_conn.php";

$errors = array();

if (isset($_POST["submit"])) {

    session_start();
    
    // Retrieve form data
    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    
    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if there are any errors
    if (empty($errors)) {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert data into the database
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        
        // Execute the statement
        if ($stmt->execute()) {
            header("Location: congratulation_page.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement and connection
        $stmt->close();
    }
}
?>

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

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-8 col-lg-10">
                    <div class="card overflow-hidden bg-opacity-25">
                        <div class="row g-0">
                            <div class="col-lg-6 d-none d-lg-block p-2">
                                <img src="assets/images/auth-img.jpg" alt="" class="img-fluid rounded h-100">
                            </div>
                            <div class="col-lg-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="#" class="logo-light">
                                            <img src="assets/images/logo.png" alt="logo" height="22">
                                        </a>
                                        <a href="#" class="logo-dark">
                                            <img src="assets/images/logo-dark.png" alt="dark logo" height="22">
                                        </a>
                                    </div>
                                    <div class="p-4">
                                        <h4 class="fs-20">Sign Up</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.</p>

                                        <!-- form -->
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="mb-3">
                                                <label for="fullname" class="form-label">Full Name</label>
                                                <input class="form-control" type="text" id="fullname"
                                                    placeholder="Enter your name" name="fullname" required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" name="email" required=""
                                                    placeholder="Enter your email">
                                                <div id="email-error" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" required="" name="password" id="password"
                                                    placeholder="Enter your password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                                <input class="form-control" type="password" required="" name="confirm_password" id="confirm_password"
                                                    placeholder="Confirm your password">
                                                <div id="confirm-password-error" class="invalid-feedback"></div>
                                            </div>
                                            <div class="mb-0 d-grid text-center">
                                                <button class="btn btn-primary fw-semibold" id="signup-button" name="submit" type="submit" disabled>Sign
                                                    Up</button>
                                            </div>

                                        </form>
                                        <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Already have account? <a href="admin.php"
                            class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a>
                    </p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Velonic - Theme by Techzaa
        </span>
    </footer>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    <!-- Ajax script -->
    <script>
        $(document).ready(function(){
            $('#emailaddress').keyup(function(){
                var email = $(this).val().trim();
                if(email.length === 0){
                    $('#email-error').hide();
                    $('#signup-button').prop('disabled', true);
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: 'check_email.php',
                    data: {email: email},
                    dataType: 'json',
                    encode: true
                })
                .done(function(data){
                    if(data.exists){
                        $('#email-error').html('Email already exists').show().css('color', 'red');
                        $('#emailaddress').css('border-color', 'red');
                        $('#signup-button').prop('disabled', true);
                    } else {
                        $('#email-error').html('Email available for registration').show().css('color', 'green');
                        $('#emailaddress').css('border-color', 'green');
                        $('#signup-button').prop('disabled', false);
                    }
                });
            });

            $('#confirm_password').keyup(function(){
                var password = $('#password').val().trim();
                var confirmPassword = $(this).val().trim();
                if(confirmPassword.length === 0 || confirmPassword !== password){
                    $('#confirm-password-error').html('Passwords do not match').show().css('color', 'red');
                    $('#signup-button').prop('disabled', true);
                    $('#password, #confirm_password').css('border-color', 'red');
                } else {
                    $('#confirm-password-error').hide();
                    $('#signup-button').prop('disabled', false);
                    $('#password, #confirm_password').css('border-color', 'green');
                }
            });
        });
    </script>

</body>
</html>
