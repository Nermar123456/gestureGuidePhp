<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free Web tutorials">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/profile.css">


    <style>
        body {
            background-color: #f0f0f0;
        }

        .main {
            background-color: white;
            margin: 0 12px 20px 70px;
            padding-bottom: 20px;
        }
    </style>
</head>

<?php include 'includes/nav.view.php'; ?>
<?php include 'includes/sidebar.view.php'; ?>

<body>
    <div class="main">
        <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px; margin-top:30px ">
            <div class="nav-tab-container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="showTab('my-info-row')">My
                            Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"
                            onclick="showTab('my-account-row')">Account Setting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"
                            onclick="showTab('my-help-row')">Help</a>
                    </li>
                </ul>
            </div>

            <div class="row" id="my-info-row">

                <div id="user-prof-container" class="" style="height:350px;">
                    <img src="image/user.jpg" alt="Profile picture"
                        class="border border-dark d-block mx-auto rounded-circle" style="width:200px; height:220px;">
                    <h4 class="text-center" style="margin:0;"><span><?php echo $_SESSION['user_name']; ?></span></h4>
                    <p class="text-center" style="margin:0;"><span><?php echo $_SESSION['user_id']; ?></span></p>
                </div>
                <div id="prof-info-container" class=" ">

                    <!-- for pesonal Information -->

                    <h4>Personal Information</h4>
                    <table class="table table-bordered" style="margin-top:12px; width:800px">

                        <tbody id="userTable">

                        </tbody>

                    </table>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit
                        Profile</button>
                    <button class="btn btn-danger" id="deleteButton">Delete Profile</button>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm">
                                        <div class="mb-3">
                                            <label for="editName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="editName" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="editEmail" name="email"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editNumber" class="form-label">Number</label>
                                            <input type="text" class="form-control" id="editNumber" name="number"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editGender" class="form-label">Gender</label>
                                            <input type="text" class="form-control" id="editGender" name="gender"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editBirthday" class="form-label">Birthday</label>
                                            <input type="date" class="form-control" id="editBirthday" name="birthday"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="editAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="editAddress" name="address"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row" id="my-account-row">
                <!-- Account Setting Content -->

                <div id="prof-info-container" class="col-sm-9 col-md-8 p-2">
                    <table class="table table-hover table-striped table-bordered" style="margin-top:12px;">

                    </table>
                </div>
            </div>

            <div class="row" id="my-help-row">
                <!-- Help Content -->

                <div id="prof-info-container" class="col-sm-9 col-md-8 p-2">
                    <table class="table table-hover table-striped table-bordered" style="margin-top:12px;">
                    </table>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
<script>
    $(document).ready(function () {
        // Assuming the user ID is stored in the session
        var userId = "<?php echo $_SESSION['user_id']; ?>";

        // Function to fetch user data by ID
        function fetchUser(userId) {
            $.ajax({
                url: 'user.api.php', // Your API endpoint
                type: 'GET',
                data: { id: userId },
                success: function (response) {
                    if (response.status === 'success') {
                        var user = response.data;
                        // Populate the HTML elements with user data
                        $('#user-prof-container img').attr('src', 'image/' + user.profile_picture); // Assuming you have a profile picture field
                        $('#user-prof-container h4 span').text(user.name);
                        $('#user-prof-container p span').text(user.id);

                        // Populate the table with user information
                        var userTable = $('#userTable');
                        userTable.append('<tr><td>ID:</td><td>' + user.id + '</td></tr>');
                        userTable.append('<tr><td>Full Name:</td><td>' + user.name + '</td></tr>');
                        userTable.append('<tr><td>Gender:</td><td>' + user.gender + '</td></tr>');
                        userTable.append('<tr><td>Place of Birth:</td><td>' + user.place_of_birth + '</td></tr>');
                        userTable.append('<tr><td>Civil Status:</td><td>' + user.civil_status + '</td></tr>');
                        userTable.append('<tr><td>Nationality:</td><td>' + user.nationality + '</td></tr>');
                        userTable.append('<tr><td>Email:</td><td>' + user.email + '</td></tr>');
                        userTable.append('<tr><td>Number:</td><td>' + user.number + '</td></tr>');
                        userTable.append('<tr><td>Birthday:</td><td>' + user.birthday + '</td></tr>');
                        userTable.append('<tr><td>Complete Address:</td><td>' + user.address + '</td></tr>');
                        // Continue to populate with other user data...
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Call the function to fetch user data
        fetchUser(userId);

        $('#editModal').on('show.bs.modal', function () {
            var userId = "<?php echo $_SESSION['user_id']; ?>";

            $.ajax({
                url: 'user.api.php',
                type: 'GET',
                data: { id: userId },
                success: function (response) {
                    if (response.status === 'success') {
                        var user = response.data;
                        $('#editName').val(user.name);
                        $('#editEmail').val(user.email);
                        $('#editNumber').val(user.number);
                        $('#editGender').val(user.gender);
                        $('#editBirthday').val(user.birthday);
                        $('#editAddress').val(user.address);
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Handle the form submission for updating user data
        $('#editForm').submit(function (event) {
            event.preventDefault();

            var userId = "<?php echo $_SESSION['user_id']; ?>";
            var formData = {
                id: userId,
                name: $('#editName').val(),
                email: $('#editEmail').val(),
                number: $('#editNumber').val(),
                gender: $('#editGender').val(),
                birthday: $('#editBirthday').val(),
                address: $('#editAddress').val()
            };

            $.ajax({
                url: 'user.api.php',
                type: 'PUT',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Profile updated successfully');
                        fetchUser(userId);  // Reload the user data after update
                        $('#editModal').modal('hide');
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#deleteButton').click(function () {
            if (confirm('Are you sure you want to delete your profile? This action cannot be undone.')) {
                var userId = "<?php echo $_SESSION['user_id']; ?>";

                $.ajax({
                    url: 'user.api.php',
                    type: 'DELETE',
                    data: JSON.stringify({ id: userId }),
                    contentType: 'application/json',
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Profile deleted successfully');
                            window.location.href = 'logout.php'; // Redirect to logout or another page
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

    });



    // profile.js

    function showTab(tabId) {
        // Hide all rows
        document.getElementById('my-info-row').style.display = 'none';
        document.getElementById('my-account-row').style.display = 'none';
        document.getElementById('my-help-row').style.display = 'none';

        // Show the selected tab
        document.getElementById(tabId).style.display = 'flex';

        let navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.classList.remove('active');
            link.removeAttribute('aria-current');
        });

        // Add active class and aria-current to the clicked nav-link
        const activeLink = document.querySelector(`[onclick="showTab('${tabId}')"]`);
        activeLink.classList.add('active');
        activeLink.setAttribute('aria-current', 'page');
    }



</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>