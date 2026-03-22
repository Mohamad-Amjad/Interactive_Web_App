<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="page-title">Recipe - Terra Kitchen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link href="css/Recipe.css" rel="stylesheet">
</head>
<body>



    <div class="nav-header" style="position: relative;">
        <a href="index.php" class="back-link">
            <i class="bi bi-arrow-left"></i> Back to Recipes
        </a>
        <div id="auth-container" style="position: absolute; top: 20px; right: 20px;">
             <span class="me-3 fw-bold d-none d-md-inline" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Welcome, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
             <a href="dashboard.php" class="btn btn-outline-dark me-2 btn-sm fw-bold">Dashboard</a>
             <a href="auth/logout.php" class="btn btn-primary-custom btn-sm fw-bold" style="background-color: var(--primary-orange); border: none;">Logout</a>
        </div>
    </div>

    <div class="main-wrapper" id="recipe-container" style="display: none;">


        <div class="hero-card mb-4 mt-n2">
            <img src="" alt="Recipe Image" id="hero-image" class="hero-image">

            <div class="hero-content">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h1 class="recipe-title m-0" id="recipe-title">Recipe Title</h1>
                    <span id="recipe-difficulty" class="badge">Difficulty</span>
                </div>

                <p class="recipe-desc text-muted mb-4" id="recipe-desc">Recipe description goes here.</p>


                <div class="info-grid mb-4">
                    <div class="info-box">
                        <span class="info-label">Prep Time</span>
                        <span class="info-value"><i class="bi bi-clock"></i> <span id="prep-time">0 mins</span></span>
                    </div>
                    <div class="info-box">
                        <span class="info-label">Cook time</span>
                        <span class="info-value"><i class="bi bi-fire"></i> <span id="cook-time">0 mins</span></span>
                    </div>
                    <div class="info-box">
                        <span class="info-label">Total</span>
                        <span class="info-value"><i class="bi bi-clock-history"></i> <span id="total-time">0 mins</span></span>
                    </div>
                    <div class="info-box">
                        <span class="info-label">Servings</span>
                        <span class="info-value"><i class="bi bi-person"></i> <span id="servings">0</span></span>
                    </div>
                    <div class="info-box">
                        <span class="info-label">Cuisine</span>
                        <span class="info-value"><i class="bi bi-geo-alt"></i> <span id="cuisine">N/A</span></span>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 tags-row" id="tags-container">

                </div>
            </div>
        </div>

        <div class="row g-4">


            <div class="col-12 col-md-4">
                <div class="content-card">
                    <h3 class="section-title">Ingredients</h3>
                    <ul class="ingredients-list" id="ingredients-list">

                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="content-card">
                    <h3 class="section-title">Instructions</h3>
                    <div id="instructions-container">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-wrapper" id="error-container" style="display: none;">
        <div class="text-center py-5">
            <h2 class="fw-bold text-dark">Recipe Not Found</h2>
            <p class="text-muted">Sorry, we couldn't find the recipe you were looking for.</p>
            <a href="index.php" class="btn btn-primary-custom mt-3 px-4">Browse Recipes</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.PHP_INTEGRATION = true;
        window.dbRecipes = <?= getDbRecipesJson() ?>;
    </script>
    <script src="js/recipes.js?v=2"></script>
    <script src="js/Recipe.js"></script>

</body>
</html>
