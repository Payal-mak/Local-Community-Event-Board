<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Community Event Board</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="style.css"/>
  <style>
    :root {
      --primary: #4361ee;
      --secondary: #3f37c9;
      --accent: #4895ef;
      --light: #f8f9fa;
      --dark: #212529;
      --success: #4cc9f0;
      --danger: #f72585;
    }
    
    .add-event-btn {
      display: inline-block;
      margin-bottom: 20px;
      background-color: var(--primary);
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      transition: all 0.3s;
    }
    
    .add-event-btn:hover {
      background-color: var(--secondary);
      transform: translateY(-2px);
    }
    
    .add-event-btn i {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="container animate__animated animate__fadeIn">
    <header class="header">
      <h1 class="animate__animated animate__fadeInDown">Local Community Events</h1>
      <p class="welcome-message animate__animated animate__fadeIn animate__delay-1s">
        Welcome, <span class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></span>! 
        <a href="auth.php?logout=1" class="logout-btn">Logout</a>
      </p>
    </header>

    <a href="add_event.php" class="add-event-btn animate__animated animate__fadeInUp">
      <i class="fas fa-plus-circle"></i> Add New Event
    </a>

    <div class="card animate__animated animate__fadeInUp animate__delay-1s">
      <h2><i class="fas fa-filter"></i> Filter Events</h2>
      <div class="filter-section">
        <div class="form-group">
          <input type="text" id="startDate" placeholder="Start Date">
          <span class="focus-border"></span>
        </div>
        <div class="form-group">
          <input type="text" id="endDate" placeholder="End Date">
          <span class="focus-border"></span>
        </div>
        <div class="filter-buttons">
          <button onclick="filterEvents()" class="btn-secondary slide-on-hover">
            <i class="fas fa-filter"></i> Filter
          </button>
          <button onclick="resetFilter()" class="btn-outline slide-on-hover">
            <i class="fas fa-redo"></i> Reset
          </button>
        </div>
      </div>
    </div>

    <div class="card animate__animated animate__fadeInUp animate__delay-2s">
      <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
      <div id="eventsList" class="events-list">
        <!-- Events will be inserted here by JavaScript -->
      </div>
    </div>
  </div>

  <!-- Font Awesome for icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="script.js"></script>
</body>
</html>