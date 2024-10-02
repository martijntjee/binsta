<?php

use RedBeanPHP\R as R;

class PostController extends BaseController
{
    protected const LANGUAGES = ['c', 'css', 'cpp', 'go', 'html', 'java', 'javascript', 'jsx', 'php', 'python', 'rust', 'typescript'];
    protected const THEMES = [
        'a11y-dark', 'atom-dark', 'base16-ateliersulphurpool.light', 'cb', 'darcula', 'default', 'dracula', 'duotone-dark', 'duotone-earth',
        'duotone-forest', 'duotone-light', 'duotone-sea', 'duotone-space', 'ghcolors', 'hopscotch', 'material-dark', 'material-light', 'material-oceanic', 'nord', 'pojoaque', 'shades-of-purple', 'synthwave84', 'vs', 'vsc-dark-plus', 'xonokai'
    ];

    public function index()
    {
        $posts = R::findAll('post');
        $likesPerPost = R::getAll('SELECT post_id, user_id, COUNT(*) AS likes FROM `like` GROUP BY post_id');
        foreach ($posts as $post) {
            $post->likes = 0;
            foreach ($likesPerPost as $like) {
                if ($like['post_id'] == $post->id) {
                    $post->likes = $like['likes'];
                    break;
                }
            }
        }
        loadTemplate('post/index.twig', ['posts' => $posts]);
    }

    public function show()
    {
        $post = $this->getBeanById('post', 'id');
        if (!$post->id) {
            error(404, 'post with id ' . $_GET['id'] . ' not found');
        } else {
            loadTemplate('post/show.twig', ['post' => $post]);
        }
    }

    public function create()
    {
        $this->authorizeUser();
        loadTemplate('post/create.twig', [
            'languages' => self::LANGUAGES,
            'themes' => self::THEMES,
        ]);
    }

    public function createPost()
    {
        $this->authorizeUser();
        $post = R::dispense('post');
        $post->caption = $_POST['caption'];
        $post->created_at = date('Y-m-d H:i:s');
        $post->user = R::load('user', $_SESSION['user']);

        $image = $this->codeToImage($_POST['code'], $_POST['language'], $_POST['theme']);
        $directory = 'images/' . $_SESSION['user'] . '/';
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $fileName = uniqid() . '.png';
        imagepng(imagecreatefromstring($image), $directory . $fileName);
        move_uploaded_file($image, $directory . $fileName);
        $post->image = $directory . $fileName;
        
        R::store($post);
        header('Location: ../');
    }

    public function edit()
    {
        $this->authorizeUser();
        loadTemplate('post/edit.twig', [
            'post' => $this->getBeanById('post', 'id'),
            'kitchens' => R::findAll('kitchen')
        ]);
    }

    public function editPost()
    {
        $this->authorizeUser();
        $post = $this->getBeanById('post', 'id');
        $post->name = $_POST['name'];
        $post->type = $_POST['type'];
        $post->level = $_POST['level'];

        $kitchenId = $_POST['kitchen_id'] ?? null;
        if ($kitchenId) {
            $post->kitchen = R::load('kitchen', $kitchenId);
        }

        R::store($post);
        header('Location: ../post/show?id=' . $post->id);
    }
}
