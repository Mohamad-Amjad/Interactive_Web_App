<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

requireLogin('auth/login.php');

// Fetch user data if needed here
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Terra Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/Home.css" rel="stylesheet">
    <style>
        .stat-card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center; border: 1px solid #eee; }
        .stat-card h3 { color: var(--primary-orange, #f05a16); font-size: 36px; margin: 0; font-weight: 800; }
        .stat-card p { color: #6c757d; margin: 5px 0 0 0; font-weight: 500; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
    </style>
</head>
<body>

    <div class="main-wrapper">
        <div class="container-fluid px-2 py-2 p-md-4">

            <div class="banner text-center text-white position-relative">
                <div id="auth-container" style="position: absolute; top: 20px; right: 20px;">
                    <span class="me-3 fw-bold d-none d-md-inline" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Welcome, <?= htmlspecialchars($user['username']) ?></span>
                    <a href="index.php" class="btn btn-outline-light me-2 btn-sm fw-bold">Home</a>
                    <a href="auth/logout.php" class="btn btn-primary-custom btn-sm fw-bold" style="background-color: var(--primary-orange); border: none;">Logout</a>
                </div>
                <img src="images/chef hat.png" alt="Chef Hat" class="chef-hat-icon">
                <h1 class="banner-title">Your Dashboard</h1>
                <p class="banner-subtitle">
                    Manage your recipes, favorites, and account settings. You're a Pro Member of Terra Kitchen.
                </p>
                <div class="mt-3">
                    <a href="contact.php" class="text-white text-decoration-underline" style="font-size: 14px;">Contact Us</a>
                </div>
            </div>
            

            <div class="search-filter-bar mb-4">
                <div class="row align-items-center g-3 w-100 m-0">
                    <div class="col-12 col-lg-6 px-1">
                        <div class="search-input-wrapper">
                            <i class="bi bi-search text-muted search-icon"></i>
                            <input type="text" id="recipe-search-input" class="form-control" placeholder="Search your recipes...">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 px-1 d-flex gap-2 justify-content-lg-end">
                        <div class="filter-dropdown">
                            <i class="bi bi-funnel"></i> All Categories <i class="bi bi-chevron-down ChevronIcon"></i>
                        </div>
                        <a href="AddRecipe.php" class="btn btn-add-recipe fw-bold text-decoration-none d-flex align-items-center justify-content-center">
                            + Add Recipe
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="results-count">
                Showing <span class="fw-bold" id="visible-recipe-count" style="color: var(--primary-orange);">0</span> of <span id="total-recipe-count">0</span> recipes
            </div>
            
            <div class="row g-4 recipe-grid" id="recipe-grid">
               
            </div>

        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.PHP_INTEGRATION = true;
        window.dbRecipes = <?= getDbRecipesJson() ?>;
    </script>
    <script src="js/recipes.js?v=2"></script>
    <script src="js/Home.js?v=2"></script>
</body>
</html>
