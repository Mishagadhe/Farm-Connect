<?php
$conn = mysqli_connect("localhost", "root", "", "farmconnect") or die(mysqli_connect_error());

$data = json_decode(file_get_contents('php://input'), true);
if ($data === null || !isset($data['text'])) {
    $response = array('status' => 'error', 'message' => 'Invalid or missing JSON data');
    echo json_encode($response);
    exit;
}

$text = mysqli_real_escape_string($conn, $data['text']);

$sql = "INSERT INTO queries1 (query) VALUES ('$text')";

if (mysqli_query($conn, $sql)) {
    $response = array('status' => 'success', 'message' => 'Speech text stored successfully');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . mysqli_error($conn));
    echo json_encode($response);
}

mysqli_close($conn);
?>