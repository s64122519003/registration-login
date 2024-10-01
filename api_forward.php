<?php
header("Content-Type: application/json");

function handleRequest($endpoint, $input) {
    $url = '';

    // Map API endpoints to specific files
    switch ($endpoint) {
        case 'login':
            $url = 'http://localhost/login/login_secured.php';  // Adjust to your server path
            break;
        case 'register':
            $url = 'http://localhost/login/register_secured.php';
            break;
        case 'reset':
            $url = 'http://localhost/login/reset_secured.php';
            break;
        case 'delete':
            $url = 'http://localhost/login/delete_secured.php';
            break;
        default:
            echo json_encode(['message' => 'Invalid endpoint']);
            exit;
    }

    // Forward the request to the corresponding PHP file using cURL
    $response = forwardRequest($url, $input);
    echo $response;
}

function forwardRequest($url, $data) {
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$method = $_SERVER['REQUEST_METHOD'];

// Retrieves the raw request body and converts JSON data into a PHP array
$input = json_decode(file_get_contents('php://input'), true);

if ($method == 'POST') {
    // API action passed via URL, e.g., ?action=register
    $endpoint = $_GET['action'];
    handleRequest($endpoint, $input);
}

?>