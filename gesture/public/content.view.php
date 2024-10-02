<?php
include 'conn.php';

// Assuming $conn is your mysqli connection
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

if ($category_id) {
    // Fetch content based on the category_id, sorted alphabetically by content_name
    $query = $conn->prepare("SELECT * FROM content WHERE category_id = ? ORDER BY content_name ASC");
    $query->bind_param("i", $category_id);
    $query->execute();
    $result = $query->get_result();
    $contentData = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Handle the case where category_id is not provided
    $contentData = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content</title>
    <style>
        body {
            background-color: #f0f0f0;
        }
        .main{
            background-color: white;
            margin: 20px 20px 20px 70px;
            padding-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
    <link rel="stylesheet" href="assets/content.css">
    <link rel="stylesheet" href="assets/lesson.css">
</head>

<body>
    <?php include 'includes/nav.view.php'; ?>
    <?php include 'includes/sidebar.view.php'; ?>

    <div class="main">
        <div class="add_content_cont">
            <div class="to_content">
                <button id="btn_content" style="    width: 120px;
                    height: 35px;
                    border-radius: 5px;
                    margin: 0;
                    border-color: transparent;
                    background-color: #ed803c;
                    color: white;">Add Content</button>

            </div>
            <div class="form_add_content">
                <form id="addContentForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category_id); ?>">
                    <h4 class="cont_h4">CONTENT</h4>

                    <div class="cont_int_container">

                        <div class="cont_name_container">
                            <label>Add a Sign Language Name</label>
                            <input type="text" placeholder="Enter Content Name" name="content_name" class="cont_name">
                        </div>

                        <div class="upload_file_container">
                            <div class="cont_pics">
                                <label class="image-file-upload" for="cont_img">
                                    <div class="icon">
                                        <img id="content_img_preview" src="" alt="Image Preview"
                                            style="display: none; width: 100px; height: 100px; object-fit: cover;">
                                        <svg id="cont_upload" xmlns="http://www.w3.org/2000/svg" fill=""
                                            viewBox="0 0 24 24">
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
                                    <div class="text">
                                        <span>Click to upload image</span>
                                    </div>
                                    <input type="file" id="cont_img" name="cont_img">
                                </label>
                                <p>Provide Picture Related to the content uploaded</p>

                            </div>
                            <div class="cont_vids">
                                <label class="image-file-upload" for="cont_vid">
                                    <div class="icon">
                                        <video src="" id="content_vid_preview"
                                            style="display: none; width: 100px; height: 100px; object-fit: cover;"></video>
                                        <svg id="cont_vid_upload" viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'
                                            xmlns:xlink='http://www.w3.org/1999/xlink'>
                                            <g transform="matrix(0.77 0 0 0.77 12 12)">
                                                <path
                                                    style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(75, 85, 99); fill-rule: nonzero; opacity: 1;"
                                                    transform=" translate(-15, -15)"
                                                    d="M 24.707 8.793 L 18.207 2.2929999999999993 C 18.019 2.105 17.765 2 17.5 2 L 7 2 C 5.895 2 5 2.895 5 4 L 5 26 C 5 27.105 5.895 28 7 28 L 23 28 C 24.105 28 25 27.105 25 26 L 25 9.5 C 25 9.235 24.895 8.981 24.707 8.793 z M 18.547 18.815 L 13.541 21.819000000000003 C 13.383 21.924 13.204 22 13 22 C 12.448 22 12 21.552 12 21 L 12 15 C 12 14.448 12.448 14 13 14 C 13.204 14 13.383 14.076 13.541 14.181 L 18.547 17.185 C 18.814 17.365 19 17.654 19 18 C 19 18.346 18.814 18.635 18.547 18.815 z M 18 10 C 17.448 10 17 9.552 17 9 L 17 3.904 L 23.096 10 L 18 10 z"
                                                    stroke-linecap="round" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <span>Click to upload Video</span>
                                    </div>
                                    <input type="file" id="cont_vid" name="cont_vid">
                                </label>
                                <p>Provide Video Related to the content uploaded</p>

                            </div>
                        </div>
                    </div>
                    <div class="cont_submit">
                        <input type="submit" placeholder="Submit" class="submit_btn">
                    </div>
                </form>
            </div>
        </div>

        <div class="content_div">
            <?php if ($contentData): ?>
                <?php foreach ($contentData as $content): ?>
                    <div class="content_container"
                        data-content-id="<?php echo htmlspecialchars($content['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="content_image_div">
                            <img src="<?php echo htmlspecialchars($content['content_image'], ENT_QUOTES, 'UTF-8'); ?>"
                                class="content_image">
                        </div>
                        <div class="content_name_div">
                            <h4 class="content_name">
                                <?php echo htmlspecialchars($content['content_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </h4>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No content available for this category.</p>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addContentForm').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: 'content.api.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.error);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    alert("An error occurred while processing your request. Please try again.");
                }

            });
        });


        $(document).ready(function () {
            $('#cont_img').on('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#content_img_preview').attr('src', e.target.result).show();
                        $('#cont_upload').hide();
                        $('#upload_cont_text').hide();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#content_img_preview').hide();
                    $('#cont_upload').show();
                    $('#upload_cont_textt').show();
                }
            });

            $('.content_container').on('click', function () {
                const contentId = $(this).data('content-id');
                if (contentId) {
                    window.location.href = 'content.details.php?content_id=' + contentId;
                }
            });


            $(document).ready(function () {
                $('#cont_vid').on('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            $('#content_vid_preview').attr('src', e.target.result).show();
                            $('#cont_vid_upload').hide();
                            $('#upload_vid_text').hide();
                        }
                        reader.readAsDataURL(file);
                    } else {
                        $('#content_vid_preview').hide();
                        $('#cont_vid_upload').show();
                        $('#upload_vid_textt').show();
                    }
                });


                const addcontentButton = document.querySelector('#btn_content');
                const contentForm = document.querySelector('.form_add_content');

                addcontentButton.addEventListener('click', function () {
                    if (contentForm.style.display === 'none' || contentForm.style.display === '') {
                        contentForm.style.display = 'block';
                    } else {
                        contentForm.style.display = 'none';
                    }
                });

                contentForm.style.display = 'none';


                const colors = ["#FF8A8A", "#B1AFFF", "#EF9C66", "#78ABA8", "#B5C0D0", "#D5F0C1", "#AC87C5", "#A1EEBD"];
                const containers = document.querySelectorAll('.content_container');

                containers.forEach((container, index) => {
                    container.style.backgroundColor = colors[index % colors.length];
                });


            });
        });

    });
</script>

</html>