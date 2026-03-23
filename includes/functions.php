<?php
session_start();


function isLoggedIn() {
    global $pdo;
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    
    if (isset($pdo)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            if (!$stmt->fetch()) {
                session_unset();
                session_destroy();
                return false;
            }
        } catch (Exception $e) {
        }
    }
    return true;
}


function requireLogin($loginUrl = 'auth/login.php') {
    if (!isLoggedIn()) {
        header("Location: " . $loginUrl);
        exit();
    }
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}


function getDbRecipesJson() {
    global $pdo;
    if (!isset($pdo)) return '[]';
    
    try {
        $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id DESC");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $formatted = [];
        foreach ($results as $row) {
            $formatted[] = [
                'id' => strval($row['id']), // Cast to string for JS strict equality
                'title' => $row['title'],
                'difficulty' => $row['difficulty'] ?: 'Easy',
                'difficultyClass' => strtolower($row['difficulty']) === 'medium' ? 'badge-medium' : (strtolower($row['difficulty']) === 'hard' ? 'badge-hard' : 'badge-easy'),
                'image' => $row['image_url'] ?: 'images/chef hat.png', // fallback
                'description' => $row['description'],
                'prepTime' => $row['prep_time'] . ' mins',
                'cookTime' => $row['cook_time'] . ' mins',
                'totalTime' => ((int)$row['prep_time'] + (int)$row['cook_time']) . ' mins',
                'servings' => $row['servings'],
                'cuisine' => $row['cuisine'],
                'tags' => !empty($row['tags']) ? array_map('trim', explode(',', $row['tags'])) : [],
                'ingredients' => json_decode($row['ingredients'], true) ?: [],
                'instructions' => json_decode($row['instructions'], true) ?: []
            ];
        }
        return json_encode($formatted);
    } catch (Exception $e) {
        return '[]';
    }
}
?>
