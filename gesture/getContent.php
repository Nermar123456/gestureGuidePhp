<?php
include 'conn.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $category_id = $_POST['category_id'] ?? null;
    $content_name = $_POST['content_name'] ?? null;

    $relative_img_path = '';
    $relative_vid_path = '';

    if (!$category_id || !$content_name) {
        echo json_encode(['error' => 'Category ID and Content Name are required']);
        exit;
    }

    if (isset($_FILES['cont_img']) && $_FILES['cont_img']['error'] === UPLOAD_ERR_OK) {
        $upload_cont_dir = __DIR__ . '/uploads/content_image/';
        $cont_name = basename($_FILES['cont_img']['name']);
        $cont_path = $upload_cont_dir . $cont_name;

        if (!is_dir($upload_cont_dir)) {
            if (!mkdir($upload_cont_dir, 0755, true)) {
                echo json_encode(["error" => "Failed to create upload directory."]);
                exit();
            }
        }

        if (move_uploaded_file($_FILES['cont_img']['tmp_name'], $cont_path)) {
            $relative_img_path = 'uploads/content_image/' . $cont_name;
        } else {
            echo json_encode(["error" => "Failed to upload image."]);
            exit();
        }
    }

    if (isset($_FILES['cont_vid']) && $_FILES['cont_vid']['error'] === UPLOAD_ERR_OK) {
        $upload_vid_dir = __DIR__ . '/uploads/vids/';
        $vid_name = basename($_FILES['cont_vid']['name']);
        $vid_path = $upload_vid_dir . $vid_name;

        if (!is_dir($upload_vid_dir)) {
            if (!mkdir($upload_vid_dir, 0755, true)) {
                echo json_encode(["error" => "Failed to create upload directory."]);
                exit();
            }
        }

        if (move_uploaded_file($_FILES['cont_vid']['tmp_name'], $vid_path)) {
            $relative_vid_path = 'uploads/vids/' . $vid_name;
        } else {
            echo json_encode(["error" => "Failed to upload video."]);
            exit();
        }
    }

    $stmt = $conn->prepare("INSERT INTO content (category_id, content_name, content_image, content_video) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $category_id, $content_name, $relative_img_path, $relative_vid_path);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Content added successfully"]);
    } else {
        echo json_encode(["error" => $stmt->error]);
    }

    $stmt->close();
} 

elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Get the category ID from the query parameter
    $category_id = $_GET['category_id'] ?? null;

    if (!$category_id) {
        echo json_encode(['error' => 'Category ID is required']);
        exit;
    }

    // Prepare SQL to fetch content by category_id
    $stmt = $conn->prepare("SELECT id, category_id, content_name, content_image, content_video FROM content WHERE category_id = ? ORDER BY content_name ASC");
    
    if ($stmt === false) {
        echo json_encode(['error' => 'Failed to prepare statement: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param('s', $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $contents = [];
    while ($row = $result->fetch_assoc()) {
        $contents[] = [
            'id' => $row['id'],
            'category_id' => $row['category_id'],
            'content_name' => $row['content_name'],
            'content_image' => '/gesture/public/' . $row['content_image'],  // Add full URL to the image path
            'content_video' => '/gesture/public/' . $row['content_video'],  // Add full URL to the video path
        ];
    }

    echo json_encode($contents);

    $stmt->close();
} 

else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
