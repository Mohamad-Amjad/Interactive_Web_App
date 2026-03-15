
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Get the recipe ID from URL params
            const urlParams = new URLSearchParams(window.location.search);
            const recipeId = urlParams.get('id');
            // 2. Find the recipe in the recipes.js array
            const recipe = recipes.find(r => r.id === recipeId);
            const container = document.getElementById('recipe-container');
            const errorContainer = document.getElementById('error-container');
            if (recipe) {
                // Recipe found, populate data
                container.style.display = 'block';
                document.getElementById('page-title').textContent = `${recipe.title} - Terra Kitchen`;
                document.getElementById('hero-image').src = recipe.image;
                document.getElementById('hero-image').alt = recipe.title;
                document.getElementById('recipe-title').textContent = recipe.title;

                // Difficulty Badge
                const diffBadge = document.getElementById('recipe-difficulty');
                diffBadge.textContent = recipe.difficulty;
                if (recipe.difficulty === 'Easy') {
                    diffBadge.className = 'badge badge-easy';
                    diffBadge.style.backgroundColor = '#111';
                    diffBadge.style.color = 'white';
                    diffBadge.style.padding = '8px 16px';
                    diffBadge.style.borderRadius = '10px';
                    diffBadge.style.fontSize = '1rem';
                    diffBadge.style.fontWeight = '500';
                } else {
                    diffBadge.className = 'badge badge-medium';
                }
                document.getElementById('recipe-desc').textContent = recipe.description;
                document.getElementById('prep-time').textContent = recipe.prepTime;
                document.getElementById('cook-time').textContent = recipe.cookTime;
                document.getElementById('total-time').textContent = recipe.totalTime;
                document.getElementById('servings').textContent = recipe.servings;
                document.getElementById('cuisine').textContent = recipe.cuisine;
                // Tags
                const tagsHtml = recipe.tags.map(tag => `<span class="tag-pill text-dark">${tag}</span>`).join('');
                document.getElementById('tags-container').innerHTML = tagsHtml;
                // Ingredients
                const ingredientsHtml = recipe.ingredients.map(ing => 
                    `<li><span class="bullet"></span><strong>${ing.name}</strong> - ${ing.amount}</li>`
                ).join('');
                document.getElementById('ingredients-list').innerHTML = ingredientsHtml;
                // Instructions
                let instructionsHtml = '';
                recipe.instructions.forEach((step, index) => {
                    instructionsHtml += `
                        <div class="instruction-step ${index === recipe.instructions.length - 1 ? 'border-0 pb-0 mb-0' : ''}">
                            <div class="step-num">${index + 1}</div>
                            <div class="step-text">${step}</div>
                        </div>
                    `;
                    instructionsHtml += `<hr class="step-divider ${index === recipe.instructions.length - 1 ? 'mb-0 mt-3' : ''}">`;
                });
                document.getElementById('instructions-container').innerHTML = instructionsHtml;
            } else {
                // Recipe not found
                errorContainer.style.display = 'block';
            }
        });