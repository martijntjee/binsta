<?php

use RedBeanPHP\R as R;

class RecipeController extends BaseController
{
    protected const RECIPE_TYPES = ['breakfast', 'lunch', 'dinner', 'dessert'];
    protected const RECIPE_LEVELS = ['easy', 'medium', 'hard'];

    public function index()
    {
        $recipes = R::findAll('post');
        loadTemplate('recipe/index.twig', ['recipes' => $recipes]);
    }

    public function show()
    {
        $recipe = $this->getBeanById('recipe', 'id');
        if (!$recipe->id) {
            error(404, 'Recipe with id ' . $_GET['id'] . ' not found');
        } else {
            loadTemplate('recipe/show.twig', ['recipe' => $recipe]);
        }
    }

    public function create()
    {
        $this->authorizeUser();
        loadTemplate('recipe/create.twig', [
            'recipe_types' => self::RECIPE_TYPES,
            'recipe_levels' => self::RECIPE_LEVELS,
            'kitchens' => R::findAll('kitchen')
        ]);
    }

    public function createPost()
    {
        $this->authorizeUser();
        $recipe = R::dispense('recipe');
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['type'];
        $recipe->level = $_POST['level'];
        $recipe->kitchen = R::load('kitchen', $_POST['kitchen']);
        R::store($recipe);
        header('Location: ../kitchen/show?id=' . $_POST['kitchen']);
    }

    public function edit()
    {
        $this->authorizeUser();
        loadTemplate('recipe/edit.twig', [
            'recipe' => $this->getBeanById('recipe', 'id'),
            'recipe_types' => self::RECIPE_TYPES,
            'recipe_levels' => self::RECIPE_LEVELS,
            'kitchens' => R::findAll('kitchen')
        ]);
    }

    public function editPost()
    {
        $this->authorizeUser();
        $recipe = $this->getBeanById('recipe', 'id');
        $recipe->name = $_POST['name'];
        $recipe->type = $_POST['type'];
        $recipe->level = $_POST['level'];

        $kitchenId = $_POST['kitchen_id'] ?? null;
        if ($kitchenId) {
            $recipe->kitchen = R::load('kitchen', $kitchenId);
        }
        
        R::store($recipe);
        header('Location: ../recipe/show?id=' . $recipe->id);
    }
}
