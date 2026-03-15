
        document.addEventListener('DOMContentLoaded', () => {
            // Add Ingredient functionality
            const btnAddIngredient = document.getElementById('btn-add-ingredient');
            const ingredientsContainer = document.getElementById('ingredients-container');

            btnAddIngredient.addEventListener('click', () => {
                const newRow = document.createElement('div');
                newRow.className = 'row g-2 mb-4 flex-nowrap ingredient-row';
                newRow.innerHTML = `
                    <div class="col-7 pe-1">
                        <input type="text" class="form-control custom-input" placeholder="Ingredient name">
                    </div>
                    <div class="col-5 ps-1 d-flex gap-2">
                        <input type="text" class="form-control custom-input flex-grow-1" placeholder="Amount">
                        <button type="button" class="btn btn-outline-danger btn-sm rounded px-2 remove-ingredient" style="border:none;" title="Remove">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
                ingredientsContainer.appendChild(newRow);

                // Attach remove event listener
                newRow.querySelector('.remove-ingredient').addEventListener('click', function() {
                    newRow.remove();
                });
            });

            // Add Step functionality
            const btnAddStep = document.getElementById('btn-add-step');
            const stepsContainer = document.getElementById('steps-container');

            btnAddStep.addEventListener('click', () => {
                const currentStepsCount = stepsContainer.querySelectorAll('.instruction-step-row').length;
                const nextStepNum = currentStepsCount + 1;

                const newRow = document.createElement('div');
                newRow.className = 'd-flex gap-3 mb-4 align-items-start instruction-step-row';
                newRow.innerHTML = `
                    <div class="step-badge">${nextStepNum}</div>
                    <textarea class="form-control custom-input flex-grow-1" rows="2" placeholder="Step ${nextStepNum} instructions"></textarea>
                    <button type="button" class="btn btn-outline-danger btn-sm rounded mt-2 remove-step" style="border:none;" title="Remove Step">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
                stepsContainer.appendChild(newRow);
                
                // Attach remove event listener and re-number
                newRow.querySelector('.remove-step').addEventListener('click', function() {
                    newRow.remove();
                    reindexSteps();
                });
            });

            // Reindex step numbers
            function reindexSteps() {
                const rows = stepsContainer.querySelectorAll('.instruction-step-row');
                rows.forEach((row, index) => {
                    const badge = row.querySelector('.step-badge');
                    const textarea = row.querySelector('textarea');
                    
                    if (badge) badge.textContent = index + 1;
                    if (textarea) textarea.placeholder = `Step ${index + 1} instructions`;
                });
            }
        });