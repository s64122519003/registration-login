<?php
header("Content-Type: application/json");
include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Retrieves the raw request body and converts JSON data into a PHP array
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($conn);
        break;
    case 'POST':
        handlePost($conn, $input);
        break;
    case 'PUT':
        handlePut($conn, $input);
        break;
    case 'DELETE':
        handleDelete($conn, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($conn) {
    $sql = "SELECT * FROM users";

    // No need to prepare if there are no parameters (can still prepare it for consistency)
    $stmt = $conn->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Get the result and fetch all rows as an associative array
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    // Return the result as JSON
    echo json_encode($result);

    // Close the statement
    $stmt->close();
}

function handlePost($conn, $input) {
    // Use positional placeholders '?'
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters (both are strings, so use "ss")
    $stmt->bind_param("ss", $input['username'], $input['password']);

    // Execute the statement
    $stmt->execute();

    // Check if the insert was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'User created successfully']);
    } else {
        echo json_encode(['message' => 'Failed to create user']);
    }

    // Close the statement
    $stmt->close();
}

function handlePut($conn, $input) {
    // Use positional placeholders '?'
    $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters in the correct order. "s" for string (for username and password), "i" for integer (for id).
    $stmt->bind_param("ssi", $input['username'], $input['password'], $input['id']);
    
    // Execute the statement
    $stmt->execute();
    
    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'User updated successfully']);
    } else {
        echo json_encode(['message' => 'No rows updated']);
    }

    // Close the statement
    $stmt->close();
}

function handleDelete($conn, $input) {
    // Use positional placeholders '?'
    $sql = "DELETE FROM users WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters in the correct order. "i" for integer (for id).
    $stmt->bind_param("i", $input['id']);

    // Execute the statement
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode(['message' => 'User deleted successfully']);
    } else {
        echo json_encode(['message' => 'No rows updated']);
    }

    // Close the statement
    $stmt->close();
}
?>