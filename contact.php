<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// If it's a POST request (from fetch), handle it and exit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        echo json_encode(['status' => 'success']);
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Required fields missing']);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Terra Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/AddRecipe.css" rel="stylesheet">
    <style>
        .auth-container { max-width: 500px; margin: 60px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        .success-message { display: none; background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-weight: 500; }
        
        .nav-actions { margin-left: auto; display: flex; align-items: center; gap: 10px; }
        .nav-actions .btn { font-size: 14px; font-weight: 600; padding: 6px 16px; border-radius: 6px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="nav-header">
        <a href="index.php" class="back-link">
            <i class="bi bi-arrow-left"></i> Home
        </a>
        <div class="nav-actions">
            <?php if(isLoggedIn()): ?>
                <a href="dashboard.php" class="btn btn-outline-dark">Dashboard</a>
                <a href="auth/logout.php" class="btn btn-primary-custom" style="background-color: var(--primary-orange); color: white; border: none;">Logout</a>
            <?php else: ?>
                <a href="auth/login.php" class="btn btn-outline-dark">Login</a>
                <a href="auth/register.php" class="btn btn-primary-custom" style="background-color: var(--primary-orange); color: white; border: none;">Register</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="auth-container mt-5">
            <div class="text-center mb-4">
                <img src="images/chef hat.png" alt="Chef Hat" style="width: 50px; background: #f05a16; border-radius: 50%; padding: 5px;">
                <h2 class="mt-3 fw-bold">Contact Us</h2>
                <p class="text-muted">Have questions? We'd love to hear from you.</p>
            </div>
            <div id="contact-success" class="success-message">
                <i class="bi bi-check-circle-fill me-2"></i>Thank you for your message! We will get back to you soon.
            </div>
            <form id="contact-form">
                <div class="form-group mb-3">
                    <label class="form-label fw-bold">Name</label>
                    <input type="text" name="name" id="contact-name" class="form-control custom-input" placeholder="Your Name" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="contact-email" class="form-control custom-input" placeholder="your@email.com" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-bold">Subject</label>
                    <input type="text" name="subject" id="contact-subject" class="form-control custom-input" placeholder="How can we help?" required>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Message</label>
                    <textarea name="message" id="contact-message" class="form-control custom-input" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100" style="background-color: var(--primary-orange, #f05a16); color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; font-size: 16px;">Send Message</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('contact-form').addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            
            fetch('contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if(response.ok) {
                    document.getElementById('contact-form').style.display = 'none';
                    document.getElementById('contact-success').style.display = 'block';
                } else {
                    alert('Error submitting form.');
                }
            })
            .catch(error => {
                console.error("Error submitting contact form", error);
            });
        });
    </script>
</body>
</html>
