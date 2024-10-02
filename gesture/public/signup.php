<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/login_signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <div class="page-container">
        <div class="signin-container">
            <div class="signform-container">
                <div class="signinForm-container">
                    <div class="sign-container">
                        <p>Sign Up</p>
                    </div>
                    <div class="inputForm-signin">
                        <form id="signupForm" class="signinForm">
                            <div class="left-side-signup">
                                <div class="firstname-container">
                                    <label>Teacher's Full Name</label>
                                    <div class="input-container">
                                        <input type="text" name="name" class="input-signup" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="username-container">
                                    <label>User Name</label>
                                    <div class="input-container">
                                        <input type="text" class="input-signup" name="user_name" placeholder="User Name" required>
                                    </div>
                                </div>
                                <div class="email-container">
                                    <label>Email</label>
                                    <div class="input-container">
                                        <input type="email" class="input-signup" name="email" placeholder="Example@gmail.com" required>
                                    </div>
                                </div>
                                <div class="pass-container">
                                    <label>Password</label>
                                    <div class="input-container">
                                        <input type="password" class="input-signup" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="conpass-container">
                                    <label>Confirm Password</label>
                                    <div class="input-container">
                                        <input type="password" class="input-signup" name="confirm_password" placeholder="Confirm Password" required> 
                                    </div>
                                </div>
                            </div>
                            <div class="right-side-signup">
                                <div class="number-container">
                                    <label>Contact Number</label>
                                    <div class="input-container">
                                        <input type="text" class="input-signup" name="number" placeholder="Contact Number" required>
                                    </div>
                                </div>
                                <div class="gender-container">
                                    <label>Gender</label>
                                    <div class="input-container">
                                        <input type="radio" name="gender" id="male" value="male" required><label for="male">Male</label>
                                        <input type="radio" name="gender" id="female" value="female" required><label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="conpass-container">
                                    <label>Birthday</label>
                                    <div class="input-container">
                                        <input type="date" class="input-signup" name="birthday" required>
                                    </div>
                                </div>
                                <div class="address-container">
                                    <label>Complete Address</label>
                                    <div class="input-container">
                                        <input type="text" class="input-signup" name="address" placeholder="Street/Barangay/City/Municipality/Province" required>
                                    </div>
                                </div>
                                <div class="terms-data-container">
                                    <input type="checkbox" class="signin-checkbox" required>
                                    <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Data Privacy Policy</a></span>
                                </div>
                                <input type="submit" name="submit-btn" value="Sign up" class="signup-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

$('#signupForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'user.api.php',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            alert(response.message);
            if (response.status === 'success') {
                window.location.href = 'login.php';
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

});
        
    </script>
</body>

</html>
