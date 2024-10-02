<?php
include 'conn.php';

$content_id = isset($_GET['content_id']) ? $_GET['content_id'] : null;

if ($content_id) {
    $query = $conn->prepare("SELECT * FROM content WHERE id = ?");
    $query->bind_param("i", $content_id);
    $query->execute();
    $result = $query->get_result();
    $contentDetail = $result->fetch_assoc();
} else {
    $contentDetail = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Details</title>
    <style>
        .category_name_cont h1 {
            font-size: 50px;
        }
        body {
            background-color: #f0f0f0;
        }
        .main{
            background-color: white;
            margin: 20px 20px 20px 80px;
            padding-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
    <link rel="stylesheet" href="assets/content.css">
</head>

<body>
    <?php include 'includes/nav.view.php'; ?>
    <?php include 'includes/sidebar.view.php'; ?>
    <div class="main">


        <?php if ($contentDetail): ?>
            <div class="content_view_container">
                <div class="content_view_items">
                    <div class="content_video_container">
                        <video style="width: 700px; height:400px;"
                            src="<?php echo htmlspecialchars($contentDetail['content_video'], ENT_QUOTES, 'UTF-8'); ?>"
                            autoplay controls loop></video>
                    </div>
                    <div class="additional_content_info">
                        <div class="content_image_container">
                            <img style="width: 250px; height: 250px;"
                                src="<?php echo htmlspecialchars($contentDetail['content_image'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="">
                        </div>
                        <div class="category_name_cont">
                            <h1><?php echo htmlspecialchars($contentDetail['content_name'], ENT_QUOTES, 'UTF-8'); ?></h1>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Content not found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>