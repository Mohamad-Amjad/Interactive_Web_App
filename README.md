# Terra Kitchen 🍳

Terra Kitchen is a modern, responsive, and fully dynamic web-based digital recipe book. Users can browse a curated list of recipes, search instantly by ingredients or tags, view detailed step-by-step cooking instructions, and interact with a dynamic "Add Recipe" form. 

This project was built from scratch utilizing Vanilla web technologies and Bootstrap 5 for layout, mimicking a pixel-perfect Figma design.

## ✨ Features

- **Dynamic Recipe Grid (`Home.html`)**: The homepage seamlessly generates and displays recipe cards automatically by parsing data from a centralized JavaScript array. Adding a new recipe is as easy as adding a new object to `recipes.js`.
- **Live Search Filtering**: A real-time search bar that instantly filters the displayed recipe cards based on recipe titles, ingredients, tags, or cuisines without requiring a page reload.
- **Dynamic Single-Page Recipe Details (`Recipe.html`)**: A unified template that catches URL parameters (e.g., `?id=pasta`) to dynamically generate beautiful, unique detail pages for every recipe, including prep times, ingredient lists, and sequential instructions.
- **Interactive Forms (`AddRecipe.html`)**: Features an intuitive form that allows users to progressively add custom ingredient rows and instruction steps via JavaScript DOM manipulation.
- **100% Mobile Responsive**: Custom CSS media queries tailored specifically to mobile devices, guaranteeing a pristine, app-like user experience regardless of screen size. 

## 🛠️ Built With

- **HTML5**: Semantic structuring.
- **CSS3 / Bootstrap 5**: Clean, modern aesthetics using flexbox and grid layouts, alongside Bootstrap's robust component library.
- **Vanilla JavaScript**: Complete DOM manipulation, URL parameter parsing, functional search algorithms, and dynamic HTML injection—zero heavy frameworks required.
- **Bootstrap Icons**: Scalable vector icons for improved UI/UX.

## 📁 Project Structure

```text
├── AddRecipe.html     # The interactive recipe insertion form
├── Home.html          # The dynamic homepage & searchable recipe grid
├── Recipe.html        # The dynamic single-page recipe template
├── css/
│   ├── AddRecipe.css
│   ├── Home.css
│   └── Recipe.css     # Modular stylesheets for each view
├── js/
│   ├── AddRecipe.js   # Logic for dynamic form rows
│   ├── Home.js        # Logic for rendering recipe cards and live search
│   ├── Recipe.js      # Logic for parsing URL params and rendering details
│   └── recipes.js     # The core database array holding all recipe data
└── images/            # Curated visual assets
```

## 🚀 Getting Started

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/terra-kitchen.git
   ```
2. **Open the project:**
   Simply navigate to the project directory and open `Home.html` in your preferred modern web browser. 
   
   *(Note: No build steps, `npm install`, or local server setup is required to interact with the site, as it relies purely on client-side vanilla JavaScript.)*

## 💡 How to Add a New Recipe
To add a new recipe to the website, open `js/recipes.js` and add a new JSON object to the `recipes` array following the established schema. The `Home.html` grid and `Recipe.html` detail routes will automatically populate your new entry!