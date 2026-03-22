<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: auth/login.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitizeInput($_POST['title'] ?? '');
    $description = sanitizeInput($_POST['description'] ?? '');
    $image_url = sanitizeInput($_POST['image_url'] ?? '');
    $prep_time = sanitizeInput($_POST['prep_time'] ?? '');
    $cook_time = sanitizeInput($_POST['cook_time'] ?? '');
    $servings = (int)($_POST['servings'] ?? 0);
    $difficulty = sanitizeInput($_POST['difficulty'] ?? '');
    $category = sanitizeInput($_POST['category'] ?? '');
    $cuisine = sanitizeInput($_POST['cuisine'] ?? '');
    $tags = sanitizeInput($_POST['tags'] ?? '');
    
    $ingredients = $_POST['ingredients'] ?? [];
    $amounts = $_POST['amounts'] ?? [];
    $instructions = $_POST['instructions'] ?? [];
    
    $ingredients_list = [];
    for ($i = 0; $i < count($ingredients); $i++) {
        if (!empty(trim($ingredients[$i]))) {
            $ingredients_list[] = [
                'name' => sanitizeInput($ingredients[$i]),
                'amount' => sanitizeInput($amounts[$i] ?? '')
            ];
        }
    }
    
    $instructions_list = [];
    foreach ($instructions as $inst) {
        if (!empty(trim($inst))) {
            $instructions_list[] = sanitizeInput($inst);
        }
    }
    
    if (empty($title)) {
        $error = 'Recipe title is required.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO recipes (user_id, title, description, image_url, prep_time, cook_time, servings, cuisine, difficulty, category, tags, ingredients, instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_SESSION['user_id'], $title, $description, $image_url, 
                $prep_time, $cook_time, $servings, $cuisine, 
                $difficulty, $category, $tags, 
                json_encode($ingredients_list), 
                json_encode($instructions_list)
            ]);
            $success = "Recipe added successfully!";
        } catch (PDOException $e) {
            $error = "Error adding recipe: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Recipe - Terra Kitchen</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="css/AddRecipe.css" rel="stylesheet">
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

    <div class="main-wrapper">
        <div class="form-container">

            <div class="form-header">
                <h1 class="page-title">Add New Recipe</h1>
                <p class="page-subtitle">Share your culinary creation with the world</p>
            </div>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?= $success ?> <br><a href="dashboard.php" class="alert-link">Return to Dashboard</a>
                </div>
            <?php endif; ?>

            <form method="POST" action="AddRecipe.php">

                <h2 class="section-title">Basic Information</h2>

                <div class="form-group mb-3">
                    <label class="form-label">Recipe Title</label>
                    <input type="text" name="title" class="form-control custom-input" placeholder="e.g., Grandma's Apple Pie" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control custom-input" rows="3" placeholder="A brief description of your recipe..." required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image_url" class="form-control custom-input" placeholder="https://example.com/image.jpg">
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6 col-md-3">
                        <label class="form-label">Prep Time (min)</label>
                        <input type="number" name="prep_time" class="form-control custom-input" value="0">
                    </div>
                    <div class="col-6 col-md-3">
                        <label class="form-label">Cooking Time (min)</label>
                        <input type="number" name="cook_time" class="form-control custom-input" value="0">
                    </div>
                    <div class="col-6 col-md-3 mt-3 mt-md-0">
                        <label class="form-label">Servings</label>
                        <input type="number" name="servings" class="form-control custom-input" value="0">
                    </div>
                    <div class="col-6 col-md-3 mt-3 mt-md-0">
                        <label class="form-label">Difficulty</label>
                        <select name="difficulty" class="form-select custom-input">
                            <option value="easy" selected>Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control custom-input" placeholder="e.g., Main Course, Dessert">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Cuisine</label>
                        <input type="text" name="cuisine" class="form-control custom-input" placeholder="e.g., Italian, Mexican">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Tags (comma-separated)</label>
                    <input type="text" name="tags" class="form-control custom-input" placeholder="e.g., quick, vegetarian, comfort-food">
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
                    <h2 class="section-title mb-0">Ingredients</h2>
                    <button type="button" id="btn-add-ingredient" class="btn btn-outline-custom btn-sm rounded-pill">+ Add Ingredient</button>
                </div>
                <div id="ingredients-container">
                    <div class="row g-2 mb-4 flex-nowrap ingredient-row">
                        <div class="col-7 pe-1">
                            <input type="text" name="ingredients[]" class="form-control custom-input" placeholder="Ingredient name" required>
                        </div>
                        <div class="col-5 ps-1 d-flex gap-2">
                            <input type="text" name="amounts[]" class="form-control custom-input flex-grow-1" placeholder="Amount" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
                    <h2 class="section-title mb-0">Instructions</h2>
                    <button type="button" id="btn-add-step" class="btn btn-outline-custom btn-sm rounded-pill">+ Add Step</button>
                </div>
                <div id="steps-container">
                    <div class="d-flex gap-3 mb-4 align-items-start instruction-step-row">
                        <div class="step-badge">1</div>
                        <textarea name="instructions[]" class="form-control custom-input flex-grow-1" rows="2" placeholder="Step 1 instructions" required></textarea>
                    </div>
                </div>

                <div class="d-flex gap-3 pb-4 mt-4">
                    <button type="submit" class="btn btn-primary-custom px-4 rounded-pill">Add Recipe</button>
                    <a href="dashboard.php" class="btn btn-outline-custom cancel-btn px-4 rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.PHP_INTEGRATION = true;
    </script>
    <script src="js/AddRecipe.js?v=2"></script>
</body>
</html>
