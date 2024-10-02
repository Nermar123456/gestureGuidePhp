<?php
include 'conn.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 204 No Content');
    exit();
}

$response = [
    'status' => 'error',
    'message' => 'Invalid request'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $user_name = filter_var($_POST['user_name'] ?? null, FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] ?? null, FILTER_SANITIZE_EMAIL);
    $number = filter_var($_POST['number'] ?? null, FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST['gender'] ?? null, FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'] ?? null, FILTER_SANITIZE_STRING);
    $confirm_password = filter_var($_POST['confirm_password'] ?? null, FILTER_SANITIZE_STRING);
    $name = filter_var($_POST['name'] ?? null, FILTER_SANITIZE_STRING);
    $birthday = filter_var($_POST['birthday'] ?? null, FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'] ?? null, FILTER_SANITIZE_STRING);

    if ($password !== $confirm_password) {
        $response['message'] = 'Passwords do not match';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // Verify email before hashing password
        error_log("Checking for existing user with email: $email");

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response['message'] = 'User already exists';
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_name, number, gender, birthday, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $name, $email, $hashed_password, $user_name, $number, $gender, $birthday, $address);

            if ($stmt->execute()) {
                $response = [
                    'status' => 'success',
                    'message' => 'Registered successfully',
                    'data' => [
                        'name' => $name,
                        'email' => $email,
                        'user_name' => $user_name,
                        'number' => $number,
                        'gender' => $gender,
                        'birthday' => $birthday,
                        'address' => $address
                    ]
                ];
            } else {
                $response['message'] = 'Registration failed';
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $response = [
                'status' => 'success',
                'message' => 'User fetched successfully',
                'data' => $user
            ];
        } else {
            $response['message'] = 'User not found';
        }
    } else {
        $result = $conn->query("SELECT * FROM users");
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        $response = [
            'status' => 'success',
            'message' => 'Users fetched successfully',
            'data' => $users
        ];
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);

    $id = intval($input['id']);
    $name = filter_var($input['name'] ?? null, FILTER_SANITIZE_STRING);
    $email = filter_var($input['email'] ?? null, FILTER_SANITIZE_EMAIL);
    $user_name = filter_var($input['user_name'] ?? null, FILTER_SANITIZE_STRING);
    $number = filter_var($input['number'] ?? null, FILTER_SANITIZE_STRING);
    $gender = filter_var($input['gender'] ?? null, FILTER_SANITIZE_STRING);
    $birthday = filter_var($input['birthday'] ?? null, FILTER_SANITIZE_STRING);
    $address = filter_var($input['address'] ?? null, FILTER_SANITIZE_STRING);

    if ($id && $name && $email) {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, user_name=?, number=?, gender=?, birthday=?, address=? WHERE id=?");
        $stmt->bind_param("sssssssi", $name, $email, $user_name, $number, $gender, $birthday, $address, $id);

        if ($stmt->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'User updated successfully'
            ];
        } else {
            $response['message'] = 'Update failed';
        }
    } else {
        $response['message'] = 'Invalid input data';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);

    $id = intval($input['id'] ?? 0);

    if ($id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $response = [
                'status' => 'success',
                'message' => 'User deleted successfully'
            ];
        } else {
            $response['message'] = 'Deletion failed: ' . $conn->error;
        }
    } else {
        $response['message'] = 'Invalid user ID';
    }
}

echo json_encode($response);