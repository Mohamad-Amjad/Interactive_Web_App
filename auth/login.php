<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (isLoggedIn()) {
    header("Location: ../dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Both username and password are required.';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Terra Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../css/AddRecipe.css" rel="stylesheet">
    <style>
        .auth-container { max-width: 400px; margin: 60px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="nav-header">
        <a href="../index.php" class="back-link">
            <i class="bi bi-arrow-left"></i> Home
        </a>
    </div>
    <div class="main-wrapper">
        <div class="auth-container mt-5">
            <div class="text-center mb-4">
                <img src="../images/chef hat.png" alt="Chef Hat" style="width: 50px; background: #f05a16; border-radius: 50%; padding: 5px;">
                <h2 class="mt-3 fw-bold">Login</h2>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group mb-3">
                    <label class="form-label">Username (or Email)</label>
                    <input type="text" name="username" class="form-control custom-input" required>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control custom-input" required>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100" style="background-color: var(--primary-orange, #f05a16); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600;">Login</button>
                <div class="text-center mt-3">
                    Don't have an account? <a href="register.php" style="color: #f05a16; text-decoration: none; font-weight: bold;">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
