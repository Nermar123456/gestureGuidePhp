<?php
include 'conn.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'] ?? '';

    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["error" => "User not logged in"]);
        exit();
    }
    $user_id = $_SESSION['user_id'];

    if (isset($_FILES['category_img']) && $_FILES['category_img']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/gesture/public/uploads/category_image/';
        $file_name = basename($_FILES['category_img']['name']);
        $file_path = $upload_dir . $file_name;

        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                echo json_encode(["error" => "Failed to create upload directory."]);
                exit();
            }
        }

        if (move_uploaded_file($_FILES['category_img']['tmp_name'], $file_path)) {
            $relative_file_path = '/gesture/public/uploads/category_image/' . $file_name;

            $stmt = $conn->prepare("INSERT INTO category (category_name, category_image, user_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $category_name, $relative_file_path, $user_id);

            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Category added successfully"]);
            } else {
                echo json_encode(["error" => $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(["error" => "Failed to upload the image. Please check directory permissions."]);
        }
    } else {
        echo json_encode(["error" => "No image was uploaded or there was an upload error."]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $stmt = $conn->prepare("SELECT id, category_name, category_image, user_id FROM category ORDER BY category_name ASC");
    $stmt->execute();
    $result = $stmt->get_result();

    $categories = [];
    while ($row = $result->fetch_assoc()) {
        $categories[] = [
            'id' => $row['id'],
            'category_name' => $row['category_name'],
            'category_image' => '/gesture/public/' . $row['category_image'],  // Add full URL to the image path
            'user_id' => $row['user_id']
        ];
        

        
    }

    echo json_encode($categories);

    $stmt->close();

} else {
    echo json_encode(["error" => "Invalid request method."]);
}
?>
