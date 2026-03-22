# Terra Kitchen 🍳 (Phase 3: PHP & MySQL)

Terra Kitchen is a modern, responsive recipe book web application. Phase 3 introduces a robust backend powered by PHP and a local MySQL database, handling user authentication, session management, and dynamic contact forms.

## ✨ New Phase 3 Features

- **User Authentication (`auth/`)**: Secure registration using `password_hash()` and login with `password_verify()`. Session handling keeps users authenticated across pages.
- **Database Integration (`includes/db.php`)**: Connects the frontend to a local WAMP MySQL database safely using PDO.
- **Dashboard (`dashboard.php`)**: A protected area that requires users to be logged in to view their account summary.
- **Dynamic Contact Form (`contact.php`)**: Submits user feedback directly into the `messages` SQL table using asynchronous Fetch API (AJAX), preserving native UI validation without forcing page reloads.

## 📁 Project Structure (Updated for Submission)

```text
├── index.php          # The main homepage (replaces Home.html)
├── contact.php        # Contact form with PHP processing
├── dashboard.php      # Authenticated user dashboard
├── database.sql       # MySQL Database dump
├── auth/
│   ├── register.php   # Registration logic & UI
│   ├── login.php      # Login logic & UI
│   └── logout.php     # Session destruction
├── includes/
│   ├── db.php         # PDO database connection
│   └── functions.php  # Helper functions (isLoggedIn, sanitizeInput)
├── css/, js/, images/ # Existing assets
└── README.md
```

## 🚀 Getting Started (WAMP/XAMPP)

1. **Database Setup:**
   - Open `phpMyAdmin` (usually `http://localhost/phpmyadmin`).
   - Create a new database named `recipe_book` (Collation: utf8mb4_general_ci).
   - Import the provided `database.sql` file to automatically generate the `users`, `messages`, and `recipes` tables.
2. **Server Setup:**
   - Place this entire project folder into your WAMP `www` folder (or XAMPP `htdocs`).
   - Open your browser and navigate to the project directory, e.g., `http://localhost/web project/index.php`.

## 💡 Notes on Frontend Integration
The frontend JavaScript (`auth.js`, `recipes.js`) was preserved as much as possible to maintain the visual fidelity of the original React/Vanilla UI, while replacing the mock localStorage authentication with secure server-side PHP sessions.