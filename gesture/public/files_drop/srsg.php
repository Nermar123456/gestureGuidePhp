$(document).ready(function () {
        fetchUser();

        $('#updateForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'PUT',
                url: 'user.api.php',
                data: JSON.stringify(Object.fromEntries(new FormData(this))),
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        fetchUser();
                        $('#updateModal').modal('hide');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        function fetchUser() {
    const user_id = <?php echo $_SESSION['user_id']; ?>;
    $.ajax({
        type: 'GET',
        url: `user.api.php?id=${user_id}`,
        dataType: 'json',
        success: function (data) {
            if (data && data.data && data.data.length > 0) {
                const user = data.data[0];
                const userTable = $('#userTable');
                userTable.empty();

                const row = `
                    <tr><td>${user.name}</td></tr>
                    <tr><td>${user.gender}</td></tr>
                    <tr><td>${user.place_of_birth}</td></tr>
                    <tr><td>${user.civil_status}</td></tr>
                    <tr><td>${user.nationality}</td></tr>
                    <tr><td>${user.email}</td></tr>
                    <tr><td>${user.number}</td></tr>
                    <tr><td>${user.birthday}</td></tr>
                    <tr><td>${user.address}</td></tr>
                    <tr><td>${user.lrn}</td></tr>
                    <tr><td>${user.school_name}</td></tr>
                    <tr><td>${user.school_address}</td></tr>
                    <tr><td>${user.year_level_program}</td></tr>
                    <tr><td>${user.father_name}</td></tr>
                    <tr><td>${user.father_birthday}</td></tr>
                    <tr><td>${user.father_occupation}</td></tr>
                    <tr><td>${user.father_contact}</td></tr>
                    <tr><td>${user.father_education}</td></tr>
                    <tr><td>${user.mother_name}</td></tr>
                    <tr><td>${user.mother_birthday}</td></tr>
                    <tr><td>${user.mother_occupation}</td></tr>
                    <tr><td>${user.mother_contact}</td></tr>
                    <tr><td>${user.mother_education}</td></tr>
                    <tr><td>${user.parent_status}</td></tr>
                    <tr><td>${user.guardian_name}</td></tr>
                    <tr><td>${user.guardian_birthday}</td></tr>
                    <tr><td>${user.guardian_relationship}</td></tr>
                    <tr><td>${user.guardian_contact}</td></tr>
                `;
                userTable.append(row);
            } else {
                console.error('User data not found or is in unexpected format');
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


    window.editUser = function (user_id) {
            $.ajax({
                type: 'GET',
                url: `user.api.php?id=${user_id}`,
                dataType: 'json',
                success: function (data) {
                    if (data.data && data.data.length > 0) {
                        const user = data.data[0];
                    $('#updateId').val(user.id);
                    $("#update_fname").val(user.name);
                    $("#update_gender").val(user.gender);
                    $("#update_birthplace").val(user.place_of_birth);
                    $("#update_civil_status").val(user.civil_status);
                    $("#update_nationality").val(user.nationality);
                    $("#update_email").val(user.email);
                    $("#update_number").val(user.number);
                    $("#update_birthday").val(user.birthday);
                    $("#update_address").val(user.address);

                    // Educational Background
                    $("#update_lrn").val(user.lrn);
                    $("#update_school_name").val(user.school_name);
                    $("#update_school_address").val(user.school_address);
                    $("#update_year_level_program").val(user.year_level_program);

                    // Parent's Background
                    $("#update_father_name").val(user.father_name);
                    $("#update_father_birthday").val(user.father_birthday);
                    $("#update_father_occ#upation").val(user.father_occupation);
                    $("#update_father_contact").val(user.father_contact);
                    $("#update_father_education").val(user.father_education);
                    $("#update_mother_name").val(user.mother_name);
                    $("#update_mother_birthday").val(user.mother_birthday);
                    $("#update_mother_occupation").val(user.mother_occupation);
                    $("#update_mother_contact").val(user.mother_contact);
                    $("#update_mother_education").val(user.mother_education);
                    $("#update_parent_status").val(user.parent_status);

                    // Guardian's Background
                    $("#update_guardian_name").val(user.guardian_name);
                    $("#update_guardian_birthday").val(user.guardian_birthday);
                    $("#update_guardian_relationship").val(user.guardian_relationship);
                    $("#update_guardian_contact").val(user.guardian_contact);
                } else {
                    console.error('User data not found or is in unexpected format');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
        window.deleteUser = function (user_id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    type: 'DELETE',
                    url: 'user.api.php',
                    data: JSON.stringify({ user_id: user_id }),
                    contentType: 'application/json',
                    dataType: 'json',
                    success: function (response) {
                        alert(response.message);
                        if (response.status === 'success') {
                            fetchUsers();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }
    });







    <?php
// Base64 encoded string
$base64_string = 'your_base64_encoded_string_here';

// Specify the output file path
$output_file = 'output_filename.jpg'; // Change the extension to match the file type

// Decode the Base64 string
$file_data = base64_decode($base64_string);

// Write the decoded data to a file
file_put_contents($output_file, $file_data);

echo "File saved to " . $output_file;
?>



<div class="content_view_container">
            <div class="content_container">
                <div class="container_content_vid">
                    <video src=""></video>

                </div>

                <div class="container_content_info">

                    <div class="container_content_img">
                        <img src="" alt="">

                    </div>

                    <div class="container_content_name">
                        <h1></h1>

                    </div>

                </div>
            </div>

            <div class="container_content_btn">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                    </svg>
                    Learned
                </button>

            </div>
        </div>
