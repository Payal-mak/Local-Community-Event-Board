<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $location = trim($_POST["location"]);
    $date = trim($_POST["date"]);
    $user_id = $_SESSION['user_id'];

    // Validate inputs
    if (empty($title) || empty($location) || empty($date)) {
        $error = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO events (title, location, date, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $title, $location, $date, $user_id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1><i class="fas fa-calendar-plus"></i> Create New Event</h1>
            </div>
            
            <?php if ($error): ?>
                <div class="error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="add_event.php" class="auth-form">
                <div class="form-group">
                    <input type="text" id="title" name="title" placeholder=" " required value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
                    <label for="title"><i class="fas fa-heading"></i> Event Title</label>
                    <div class="focus-border"></div>
                </div>
                
                <div class="form-group">
                    <input type="text" id="location" name="location" placeholder=" " required value="<?php echo isset($_POST['location']) ? htmlspecialchars($_POST['location']) : ''; ?>">
                    <label for="location"><i class="fas fa-map-marker-alt"></i> Location</label>
                    <div class="focus-border"></div>
                </div>
                
                <div class="form-group">
                    <input type="text" id="date" name="date" placeholder=" " required value="<?php echo isset($_POST['date']) ? htmlspecialchars($_POST['date']) : ''; ?>">
                    <label for="date"><i class="fas fa-calendar-day"></i> Date & Time</label>
                    <div class="focus-border"></div>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Create Event
                </button>
                
                <a href="index.php" class="btn-outline" style="margin-top: 1rem; display: inline-block;">
                    <i class="fas fa-arrow-left"></i> Back to Events
                </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                time_24hr: true,
                allowInput: true
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>