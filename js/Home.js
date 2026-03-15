    
        document.addEventListener('DOMContentLoaded', () => {
            const recipeGrid = document.getElementById('recipe-grid');
            const searchInput = document.getElementById('recipe-search-input');
            const visibleCountSpan = document.getElementById('visible-recipe-count');
            const totalCountSpan = document.getElementById('total-recipe-count');
            
            // Function to safely truncate description for preview
            function truncateContent(text, maxLength) {
                if (text.length <= maxLength) return text;
                return text.substring(0, maxLength) + '...';
            }

            // Function to render all recipes
            function renderRecipes(recipesToRender) {
                recipeGrid.innerHTML = ''; // Clear container
                
                recipesToRender.forEach(recipe => {
                    // Create search terms string
                    const searchTerms = `${recipe.title} ${recipe.tags.join(' ')} ${recipe.cuisine} ${recipe.ingredients.map(i=>i.name).join(' ')}`.toLowerCase();
                    
                    // Build HTML
                    const cardHTML = `
                        <div class="col-12 col-sm-6 col-lg-3 js-recipe-card" data-search-terms="${searchTerms}">
                            <a href="Recipe.html?id=${recipe.id}" class="text-decoration-none">
                                <div class="card recipe-card border-0 h-100">
                                    <img src="${recipe.image}" class="card-img-top" alt="${recipe.title}">
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title fw-bold m-0 mt-1">${recipe.title}</h5>
                                            <span class="badge ${recipe.difficultyClass}">${recipe.difficulty}</span>
                                        </div>
                                        <p class="card-desc text-muted flex-grow-1 mt-1">${truncateContent(recipe.description, 85)}</p>
                                        <div class="recipe-meta text-muted mb-3 d-flex gap-3">
                                            <span><i class="bi bi-clock"></i> ${recipe.totalTime}</span>
                                            <span><i class="bi bi-person"></i> ${recipe.servings}</span>
                                            <span><i class="bi bi-flower1"></i> ${recipe.cuisine}</span>
                                        </div>
                                        <div class="tags d-flex flex-wrap gap-2">
                                            ${recipe.tags.slice(0, 3).map(tag => `<span class="tag-pill">${tag}</span>`).join('')}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                    recipeGrid.insertAdjacentHTML('beforeend', cardHTML);
                });
            }

            // Initial Render (recipes array is loaded from recipes.js)
            if (typeof recipes !== 'undefined') {
                renderRecipes(recipes);
                totalCountSpan.textContent = recipes.length;
                visibleCountSpan.textContent = recipes.length;
            }

            // Search Logic
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();
                const allCards = document.querySelectorAll('.js-recipe-card');
                let visibleCount = 0;

                allCards.forEach(card => {
                    const searchableText = card.getAttribute('data-search-terms');
                    if (searchableText.includes(searchTerm)) {
                        card.style.display = ''; // Show
                        visibleCount++;
                    } else {
                        card.style.display = 'none'; // Hide
                    }
                });

                visibleCountSpan.textContent = visibleCount;
            });
        });