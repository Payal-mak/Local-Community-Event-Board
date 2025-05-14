<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit("Unauthorized");
}

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['user_id'];
$event_id = $data['eventId'];
$status = $data['status'];

// Check if RSVP already exists
$stmt = $conn->prepare("SELECT id FROM rsvps WHERE user_id = ? AND event_id = ?");
$stmt->bind_param("ii", $user_id, $event_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing RSVP
    $stmt = $conn->prepare("UPDATE rsvps SET status = ? WHERE user_id = ? AND event_id = ?");
    $stmt->bind_param("sii", $status, $user_id, $event_id);
} else {
    // Insert new RSVP
    $stmt = $conn->prepare("INSERT INTO rsvps (user_id, event_id, status) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $event_id, $status);
}

$stmt->execute();
echo json_encode(["success" => true]);
?>