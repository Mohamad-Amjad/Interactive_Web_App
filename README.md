# Terra Kitchen 🍳

Terra Kitchen is a modern, responsive recipe book web application. It features a robust PHP and MySQL backend to handle user authentication, recipe management, dynamic contact forms, and a secure checkout process.

## ✨ Features

- **User Authentication**: Secure user registration and login system.
- **Recipe Management**: Users can view, search, and add custom recipes with dynamically added ingredients and instructions.
- **Interactive UI**: Clean, responsive design tailored for all devices.
- **Contact Form**: Dynamic user feedback submission process.
- **User Dashboard**: A personalized dashboard area for authenticated users.

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 
- **Database**: MySQL

## 🚀 Getting Started

### Prerequisites
- A local server environment like XAMPP, WAMP, or MAMP.

### Installation

1. **Database Setup:**
   - Open `phpMyAdmin` (typically at `http://localhost/phpmyadmin`).
   - Create a new database named `recipe_book` (Collation: `utf8mb4_general_ci`).
   - Import the provided `database.sql` file from the project root to automatically generate the required tables.

2. **Server Setup:**
   - Place this entire project folder into your local server's document root directory (e.g., the `www` folder for WAMP or `htdocs` for XAMPP).
   - Ensure your Apache and MySQL services are running.

3. **Run the Application:**
   - Open your web browser and navigate to the project URL, e.g., `http://localhost/web project/index.php` (adjust based on your folder name).

## 📁 Project Structure

- `index.php` - The main homepage
- `dashboard.php` - Authenticated user account summary
- `contact.php` - Contact form integrated with the database
- `auth/` - Contains user login, registration, and logout logic
- `includes/` - Database connection and helper functions
- `css/`, `js/`, `images/` - Styles, interactive scripts, and image assets
- `database.sql` - Ready-to-import MySQL database layout
