<?php
session_start();
include 'db.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? 0;

$sql = "SELECT e.*, 
        (SELECT COUNT(*) FROM rsvps WHERE event_id = e.id AND status = 'going') AS going_count,
        (SELECT status FROM rsvps WHERE event_id = e.id AND user_id = ?) AS user_status
        FROM events e ORDER BY e.date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
$stmt->close();
$conn->close();
?>