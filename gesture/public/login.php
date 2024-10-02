<?php
include 'conn.php';
session_start();
$message = '';

$response = [
    'status' => 'error',
    'message' => 'Login failed'
];

if (isset($_POST['submit-btn'])) {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location: admin_pannel.php');
                exit();
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_full_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_number'] = $row['number'];
                $_SESSION['user_gender'] = $row['gender'];
                $_SESSION['user_birthday'] = $row['birthday'];
                $_SESSION['user_password'] = $row['password'];
                $_SESSION['user_address'] = $row['address'];
                header('location: index.php');
                exit();
            }
        } else {
            $message = 'Incorrect email or password';
        }
    } else {
        $message = 'Incorrect email or password';
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/login_signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>


    <div class="page-container">

        <div class="login-container">

            <!-- login form container for user -->
            <div class="form-container">
                <div class="loginForm-container">

                    <div class="log-container">
                          <!-- Display error message if there's any -->
    <?php if ($message): ?>
        <div class="error-message"><?php echo htmlspecialchars($message); ?>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
        </div>
    <?php endif; ?>
                        <p>Log In</p>
                    </div>

                    <div class="inputForm-login">

                        <form class="loginFrom" method="post" id="loginForm" onsubmit="return submitForm();">

                            <div class="user-login">
                                <label>Email</label>
                                <div class="user-container">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-person" viewBox="0 0 16 16">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                    </svg>

                                    <input type="text" name="email" class="input-signup" id="username" placeholder="@gmail.com" required>
                                </div>
                            </div>


                            <div class="pass-login">
                                <label>Password</label>
                                <div class="password-container">

                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100"
                                        viewBox="0 0 50 50">
                                        <path
                                            d="M 25 3 C 18.363281 3 13 8.363281 13 15 L 13 20 L 9 20 C 7.355469 20 6 21.355469 6 23 L 6 47 C 6 48.644531 7.355469 50 9 50 L 41 50 C 42.644531 50 44 48.644531 44 47 L 44 23 C 44 21.355469 42.644531 20 41 20 L 37 20 L 37 15 C 37 8.363281 31.636719 3 25 3 Z M 25 5 C 30.566406 5 35 9.433594 35 15 L 35 20 L 15 20 L 15 15 C 15 9.433594 19.433594 5 25 5 Z M 9 22 L 41 22 C 41.554688 22 42 22.445313 42 23 L 42 47 C 42 47.554688 41.554688 48 41 48 L 9 48 C 8.445313 48 8 47.554688 8 47 L 8 23 C 8 22.445313 8.445313 22 9 22 Z M 25 30 C 23.300781 30 22 31.300781 22 33 C 22 33.898438 22.398438 34.6875 23 35.1875 L 23 38 C 23 39.101563 23.898438 40 25 40 C 26.101563 40 27 39.101563 27 38 L 27 35.1875 C 27.601563 34.6875 28 33.898438 28 33 C 28 31.300781 26.699219 30 25 30 Z">
                                        </path>
                                    </svg>
                                    <input type="password" name="password" class="input-signup" id="password" placeholder="Password" required>
                                </div>

                                <div class="btn-container">
                                    <div class="checkbox-container">
                                        <input type="checkbox" class="checkbox" required>
                                        <label>Remember Me</label>
                                    </div>

                                    <a href="#"><span class="span">Forgot password?</span></a>
                                </div>
                            </div>



                            <div class="capcha-container">
                                <p>Please check the box below to proceed.</p>

                               
                                    <div class="g-recaptcha" data-sitekey="6LdYa9UpAAAAALEkd4R8DSGZ1IIDnMNRRixAtCB5"
                                        data-callback="verifyCaptcha"></div><br>
                                    <div id='g-recaptcha-error'></div>

                                    <script>
                                        // Function to check if the CAPTCHA is checked before form submission
                                        function submitForm() {
                                            var response = grecaptcha.getResponse();
                                            console.log(response.length)
                                            if (response.length === 0) {
                                                document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red">Please check the CAPTCHA</span> ';
                                                return false;
                                            } return true;

                                        }
                                        // Function to clear CAPTCHA error after successful verification
                                        function verifyCaptcha() {
                                            document.getElementById('g-recaptcha-error').innerHTML = '';
                                        }
                                    </script>

                          
                            </div>

                            <div class="login-btn">
                                <input type="submit" name="submit-btn" value="Log in" class="submitLogin">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="logo-container">


                <div class="img-logo">
                    <img src="image/full_logo.jpg">
                </div>
                <p>The life of teacher is easy</p>
                <a href="signup.php"><button id="sp">Sign Up</button></a>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

        <script src="script.js"></script>

</body>

</html>