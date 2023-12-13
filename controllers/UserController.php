<?php

use RedBeanPHP\R as R;

class UserController extends BaseController
{
    public function login()
    {
        loadTemplate('user/login.twig');
    }

    public function loginPost()
    {
        $users = R::findAll('user');

        foreach ($users as $user) {
            if ($user->username == $_POST['username']) {
                if (password_verify($_POST['password'], $user->password)) {
                    $_SESSION['user'] = $user->id;
                    $_SESSION['username'] = ucfirst($user->username);
                    header('Location: ../recipe');
                } else {
                    loadTemplate('user/login.twig', ['error' => 'Incorrect password']);
                }
            } else {
                loadTemplate('user/login.twig', ['error' => 'Incorrect username']);
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ../user/login');
    }

    public function register()
    {
        loadTemplate('user/register.twig');
    }

    public function registerPost()
    {
        if (R::findOne('user', 'username = ?', [$_POST['username']])) {
            loadTemplate('user/register.twig', ['error' => 'Username is already taken']);
        } else if ($_POST['password'] != $_POST['confirm_password']) {
            loadTemplate('user/register.twig', ['error' => 'Passwords do not match']);
        } else if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
            loadTemplate('user/register.twig', ['error' => 'Please fill in all fields']);
        } else {
            // register user
            $user = R::dispense('user');
            $user->username = $_POST['username'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            R::store($user);

            // login user
            $_SESSION['user'] = $user->id;
            $_SESSION['username'] = ucfirst($user->username);
            header('Location: ../recipe');
        }
    }
}
