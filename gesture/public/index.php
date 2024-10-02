<?php
include 'conn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<?php include 'includes/nav.view.php'; ?>
<?php include 'includes/sidebar.view.php'; ?>

<a href=""></a>
    <div class="container">
        <h1>User Management</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Name</th>
                    <th>Number</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTable">

            </tbody>
        </table>
    </div>


    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <input type="hidden" name="id" id="updateId">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="updateName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="updateEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateUserName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="updateUserName" name="user_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateNumber" class="form-label">Number</label>
                            <input type="text" class="form-control" id="updateNumber" name="number" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateGender" class="form-label">Gender</label>
                            <select class="form-control" id="updateGender" name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="updateBirthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="updateBirthday" name="birthday" required>
                        </div>
                        <div class="mb-3">
                            <label for="updateAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="updateAddress" name="address" required>
                        </div>
                        <div class="modal-footer">
                            <button type```html
                            type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <script>
    $(document).ready(function() {
        fetchUsers();

        $('#updateForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'PUT',
                url: 'user.api.php',
                data: JSON.stringify(Object.fromEntries(new FormData(this))),
                contentType: 'application/json',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        fetchUsers();
                        $('#updateModal').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        function fetchUsers() {
            $.ajax({
                type: 'GET',
                url: 'user.api.php',
                dataType: 'json',
                success: function(data) {
                    const userTable = $('#userTable');
                    userTable.empty();
                    data.data.forEach(user => {
                        const row = `
                            <tr>
                                <td>${user.name}</td>
                                <td>${user.email}</td>
                                <td>${user.user_name}</td>
                                <td>${user.number}</td>
                                <td>${user.gender}</td>
                                <td>${user.birthday}</td>
                                <td>${user.address}</td>
                                <td>
                                    <button class="btn btn-warning" onclick="editUser(${user.id})">Edit</button>
                                    <button class="btn btn-danger" onclick="deleteUser(${user.id})">Delete</button>
                                </td>
                            </tr>
                        `;
                        userTable.append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        window.editUser = function(id) {
            $.ajax({
                type: 'GET',
                url: `user.api.php?id=${id}`,
                dataType: 'json',
                success: function(data) {
                    const user = data.data;
                    $('#updateId').val(user.id);
                    $('#updateName').val(user.name);
                    $('#updateEmail').val(user.email);
                    $('#updateUserName').val(user.user_name);
                    $('#updateNumber').val(user.number);
                    $('#updateGender').val(user.gender);
                    $('#updateBirthday').val(user.birthday);
                    $('#updateAddress').val(user.address);
                    $('#updateModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        window.deleteUser = function(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    type: 'DELETE',
                    url: 'user.api.php',
                    data: JSON.stringify({ id: id }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.status === 'success') {
                            fetchUsers();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
