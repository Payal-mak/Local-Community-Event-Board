<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="style.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .error-message {
            color: #ff6b6b;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="auth-container animate__animated animate__zoomIn">
        <!-- Login Form -->
        <div class="auth-form animate__animated animate__fadeInLeft">
            <div class="form-header">
                <i class="fas fa-sign-in-alt"></i>
                <h2>Login</h2>
            </div>
            <?php 
            if (isset($_SESSION['login_error'])) {
                echo '<div class="error-message">' . $_SESSION['login_error'] . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="auth.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn-login pulse-on-hover">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>

        <div class="divider">
            <span>OR</span>
        </div>

        <!-- Registration Form -->
        <div class="auth-form animate__animated animate__fadeInRight">
            <div class="form-header">
                <i class="fas fa-user-plus"></i>
                <h2>Register</h2>
            </div>
            <?php 
            if (isset($_SESSION['register_error'])) {
                echo '<div class="error-message">' . $_SESSION['register_error'] . '</div>';
                unset($_SESSION['register_error']);
            }
            ?>
            <form action="auth.php" method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="register" class="btn-register pulse-on-hover">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
        </div>
    </div>
</body>
</html>