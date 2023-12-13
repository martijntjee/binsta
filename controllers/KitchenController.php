<?php

use RedBeanPHP\R as R;

class KitchenController extends BaseController
{
    public function index()
    {
        $kitchens = R::findAll('kitchen');
        loadTemplate('kitchen/index.twig', ['kitchens' => $kitchens]);
    }

    public function show()
    {
        $kitchen = $this->getBeanById('kitchen', 'id');
        if (!$kitchen->id) {
            error(404, 'Kitchen with id ' . $_GET['id'] . ' not found');
        } else {
            loadTemplate('kitchen/show.twig', ['kitchen' => $kitchen]);
        }
    }
    
    public function create()
    {
        $this->authorizeUser();
        loadTemplate('kitchen/create.twig');
    }

    public function createPost()
    {
        $this->authorizeUser();
        $kitchen = R::dispense('kitchen');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);
        header('Location: ../kitchen/show?id=' . $kitchen->id);
    }

    public function edit()
    {
        $this->authorizeUser();
        loadTemplate('kitchen/edit.twig', [
            'kitchen' => $this->getBeanById('kitchen', 'id')
        ]);
    }

    public function editPost()
    {
        $this->authorizeUser();
        $kitchen = $this->getBeanById('kitchen', 'id');
        $kitchen->name = $_POST['name'];
        $kitchen->description = $_POST['description'];
        R::store($kitchen);
        header('Location: ../kitchen/show?id=' . $kitchen->id);
    }
}
