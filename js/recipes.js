const staticRecipes = [
    {
        id: 'pasta',
        title: 'Creamy Carbonara Pasta',
        difficulty: 'Medium',
        difficultyClass: 'badge-medium',
        image: 'images/pasta.png',
        description: 'A classic Italian pasta dish with a rich, creamy sauce made with eggs, cheese, and crispy pancetta.',
        prepTime: '10 mins',
        cookTime: '20 mins',
        totalTime: '30 mins',
        servings: 4,
        cuisine: 'Italian',
        tags: ['pasta', 'Italian', 'Comfort-food', 'quick'],
        ingredients: [
            { name: 'Spaghetti', amount: '400g' },
            { name: 'Pancetta or bacon', amount: '200g diced' },
            { name: 'Eggs', amount: '4 large' },
            { name: 'Parmesan cheese', amount: '1 cup, grated' },
            { name: 'Black pepper', amount: 'To taste' },
            { name: 'Salt', amount: 'For pasta water' },
            { name: 'Garlic', amount: '2 cloves, minced' }
        ],
        instructions: [
            'Bring a large pot of salted water to boil and cook spaghetti according to package directions.',
            'While pasta cooks, fry pancetta in a large skillet over medium heat until crispy, about 8-10 minutes.',
            'In a bowl, whisk together eggs, parmesan cheese, and a generous amount of black pepper.',
            'Reserve 1 cup of pasta water, then drain the pasta.',
            'Remove skillet from heat and add the hot pasta to the pancetta.',
            'Quickly pour in the egg mixture, tossing constantly. Add pasta water a little at a time to create a creamy sauce.',
            'Serve immediately with extra parmesan and black pepper.'
        ]
    },
    {
        id: 'steak',
        title: 'Perfect Grill Steak',
        difficulty: 'Easy',
        difficultyClass: 'badge-easy',
        image: 'images/perfect grill steak.png',
        description: 'Juicy, perfectly seasoned ribeye steak with a beautiful crust and tender, flavorful inside.',
        prepTime: '5 mins',
        cookTime: '20 mins',
        totalTime: '25 mins',
        servings: 2,
        cuisine: 'American',
        tags: ['beef', 'grilling', 'protein'],
        ingredients: [
            { name: 'Ribeye Steak', amount: '2 thick cuts' },
            { name: 'Olive Oil', amount: '2 tbsp' },
            { name: 'Butter', amount: '3 tbsp' },
            { name: 'Garlic', amount: '3 cloves, smashed' },
            { name: 'Fresh Rosemary', amount: '2 sprigs' },
            { name: 'Coarse Sea Salt', amount: 'To taste' },
            { name: 'Black Pepper', amount: 'Freshly cracked' }
        ],
        instructions: [
            'Remove steaks from the refrigerator 30 minutes before grilling to bring them to room temperature.',
            'Pat steaks dry with a paper towel and generously season both sides with salt and pepper.',
            'Heat a cast-iron skillet or grill over high heat until smoking hot.',
            'Add olive oil, then place steaks in the pan. Sear for 4-5 minutes per side for medium-rare.',
            'During the last 2 minutes, add butter, garlic, and rosemary to the pan. Baste the steaks with the melted butter.',
            'Remove steaks from heat and let them rest for 5-10 minutes before slicing.'
        ]
    },
    {
        id: 'cake',
        title: 'Decadent Chocolate Cake',
        difficulty: 'Medium',
        difficultyClass: 'badge-medium',
        image: 'images/decadent chocolate cake.png',
        description: 'Rich, moist chocolate cake with silky chocolate ganache frosting that melts in your mouth.',
        prepTime: '20 mins',
        cookTime: '35 mins',
        totalTime: '55 mins',
        servings: 12,
        cuisine: 'American',
        tags: ['chocolate', 'dessert', 'cake'],
        ingredients: [
            { name: 'Flour', amount: '2 cups' },
            { name: 'Sugar', amount: '2 cups' },
            { name: 'Cocoa Powder', amount: '3/4 cup' },
            { name: 'Baking Powder', amount: '2 tsp' },
            { name: 'Eggs', amount: '2 large' },
            { name: 'Milk', amount: '1 cup' },
            { name: 'Vegetable Oil', amount: '1/2 cup' },
            { name: 'Boiling Water', amount: '1 cup' },
            { name: 'Vanilla Extract', amount: '1 tsp' }
        ],
        instructions: [
            'Preheat oven to 350°F (175°C). Grease and flour two 9-inch round baking pans.',
            'In a large bowl, stir together the sugar, flour, cocoa, baking powder, baking soda and salt.',
            'Add the eggs, milk, oil, and vanilla, mix for 2 minutes on medium speed of mixer.',
            'Stir in the boiling water last. Batter will be thin. Pour evenly into the prepared pans.',
            'Bake 30 to 35 minutes in the preheated oven, until a toothpick inserted comes out clean.',
            'Cool for 10 minutes before removing from pans to wire racks to cool completely.'
        ]
    },
    {
        id: 'salad',
        title: 'Classic Caesar Salad',
        difficulty: 'Easy',
        difficultyClass: 'badge-easy',
        image: 'images/classic caseer salad.png',
        description: 'Crisp romaine lettuce with creamy Caesar dressing, crunchy croutons, and fresh parmesan.',
        prepTime: '15 mins',
        cookTime: '0 mins',
        totalTime: '15 mins',
        servings: 4,
        cuisine: 'American',
        tags: ['salad', 'healthy', 'vegetarian'],
        ingredients: [
            { name: 'Romaine Lettuce', amount: '2 large heads' },
            { name: 'Parmesan Cheese', amount: '1/2 cup, shaved' },
            { name: 'Croutons', amount: '1 cup' },
            { name: 'Mayonnaise', amount: '1/2 cup' },
            { name: 'Garlic', amount: '2 cloves, minced' },
            { name: 'Lemon Juice', amount: '2 tbsp' },
            { name: 'Dijon Mustard', amount: '1 tsp' },
            { name: 'Anchovy Paste', amount: '1 tsp' },
            { name: 'Black Pepper', amount: 'To taste' }
        ],
        instructions: [
            'Wash and dry romaine lettuce thoroughly. Tear into bite-sized pieces and place in a large bowl.',
            'In a small bowl, whisk together mayonnaise, garlic, lemon juice, mustard, and anchovy paste to make the dressing.',
            'Gradually pour the dressing over the lettuce, tossing gently to coat evenly.',
            'Add the croutons and half of the shaved parmesan cheese. Toss gently once more.',
            'Garnish with the remaining parmesan cheese and a sprinkle of freshly ground black pepper.',
            'Serve immediately for maximum crispness.'
        ]
    }
];

const recipes = (typeof window.dbRecipes !== 'undefined') ? [...window.dbRecipes, ...staticRecipes] : staticRecipes;
