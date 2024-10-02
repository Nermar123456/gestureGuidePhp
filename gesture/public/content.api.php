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


    $content_image = '';
    $content_video = '';

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
    $stmt->bind_param('isss', $category_id, $content_name, $relative_img_path, $relative_vid_path);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Category added successfully"]);
    } else {
        echo json_encode(["error" => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
