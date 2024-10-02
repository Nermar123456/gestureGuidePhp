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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="assets/lesson.css">
    <link rel="stylesheet" href="assets/category.css">

</head>

<body>
    <?php include 'includes/nav.view.php'; ?>
    <?php include 'includes/sidebar.view.php'; ?>
    <div class="main">
        <div class="add_content_cont">
            <div class="to_categ_button">
                <h2>Adding Category</h2>
                <a href="content.view.php">Add Content</a>
            </div>
            <div class="form_add_category">
                <form id="categoryForm" method="post" enctype="multipart/form-data">

                    <div class="cont_int_container">

                        <div class="cont_name_container">
                            <label>Add Category Name</label>
                            <input type="text" placeholder="Enter Category Name" name="category_name" class="category_name">
                        </div>

                        <div class="upload_file_container_category">
                            <div class="category_pics">
                                <label class="image-file-upload_category" for="category_img">
                                    <div class="icon_categ">
                                    <img id="category_img_preview" src="" alt="Image Preview" style="display: none; width: 100px; height: 100px; object-fit: cover;">
                                        <svg id="upload_icon" xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                            <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                            <g stroke-linejoin="round" stroke-linecap="round"
                                                id="SVGRepo_tracerCarrier">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path fill=""
                                                    d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text_categ">
                                        <span>Click to upload image</span>
                                    </div>
                                    <input type="file" id="category_img" name="category_img">
                                </label>
                                <p>Provide Picture Related to the content uploaded</p>

                            </div>

                        </div>
                    </div>
                    <div class="cont_submit">
                        <input type="submit" value="submit" placeholder="Submit" class="submit_btn">
                    </div>
                </form>
            </div>


        </div>
        <div class="category_div"  id="category_div">
            <div class="category_container">
                <div class="category_image_div">
                    <img src="" id="category_image">
                </div>

                <div class="category_name_div">
                    <h4 id="category_name"></h4>
                </div>

            </div>

        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#category_img').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#category_img_preview').attr('src', e.target.result).show();
                $('#upload_icon').hide();
                $('#upload_text').hide();
            }
            reader.readAsDataURL(file);
        } else {
            $('#category_img_preview').hide();
            $('#upload_icon').show();
            $('#upload_text').show();
        }
    });

    function loadCategories() {
        $.ajax({
            url: 'category.api.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    $('#category_div').empty(); // Clear the current categories

                    response.forEach(function(category) {
                        const categoryHTML = `
                            <div class="category_container">
                                <div class="category_image_div">
                                    <img src="${category.category_image}" alt="${category.category_name}" id="category_image">
                                </div>
                                <div class="category_name_div">
                                    <h4 id="category_name">${category.category_name}</h4>
                                </div>
                            </div>
                        `;
                        $('#category_div').append(categoryHTML);
                    });
                } else {
                    $('#category_div').html('<p>No categories found.</p>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                alert("An error occurred while fetching categories. Please try again.");
            }
        });
    }

    // Load categories when the page is ready
    loadCategories();



    $('#categoryForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Create a FormData object
        var formData = new FormData(this);

        $.ajax({
            url: 'category.api.php', // API endpoint
            type: 'POST',
            data: formData,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false, let the browser decide
            success: function(response) {
                // Handle success
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'add_category.material.php'; // Reload the page or redirect
                } else {
                    alert(response.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle error
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                alert("An error occurred while processing your request. Please try again.");
            }
        });
    });
});

    </script>

</html>