<?php
include("conn.php");

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    getUsers($conn);
} elseif ($requestMethod == "POST") {
    addUsers($conn);
} elseif ($requestMethod == "DELETE") {
    deleteUsers($conn);
}  
else {
    echo json_encode(["message" => "Invalid request"]);
}

// Function to fetch users
function getUsers($conn) {
    $sql = "SELECT username, Name, email FROM user";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        echo json_encode($users);
    } else {
        echo json_encode(["message" => "No users found"]);
    }
}

// Function to add a user
function addUsers($conn) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if all fields exist
    if (!empty($data['username']) && !empty($data['Name']) && !empty($data['email']) && !empty($data['password'])) {
        $username = mysqli_real_escape_string($conn, $data['username']);
        $name = mysqli_real_escape_string($conn, $data['Name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $password = $password = mysqli_real_escape_string($conn, $data['password']);


        // Check if username or email already exists
        $checkUser = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $checkUser);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(["message" => "Username or email already exists"]);
            return;
        }

        // Insert user
        $sql = "INSERT INTO user (username, Name, email, password) VALUES ('$username', '$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["message" => "User added successfully"]);
        } else {
            echo json_encode(["message" => "Failed to add user", "error" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["message" => "Incomplete data"]);
    }
}

   // Function to delete a user
function deleteUsers($conn) {
    // Get the raw DELETE request data
    $data = json_decode(file_get_contents("php://input"), true);

    if (!empty($data['id'])) {
        $id = intval($data['id']); // Convert to integer and sanitize input

        // Check if the user exists
        $checkUser = "SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $checkUser);

        if (mysqli_num_rows($result) > 0) {
            // Delete user query
            $sql = "DELETE FROM user WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["message" => "User deleted successfully"]);
            } else {
                echo json_encode(["message" => "Failed to delete user", "error" => mysqli_error($conn)]);
            }
        } else {
            echo json_encode(["message" => "User not found"]);
        }
    } else {
        echo json_encode(["message" => "User ID is required"]);
    }
}

?>
