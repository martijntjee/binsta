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
        try {
            $users = R::findAll('user');
            $loggedIn = false;

            foreach ($users as $user) {
                if ($user->email == $_POST['email']) {
                    if (password_verify($_POST['password'], $user->password)) {
                        $_SESSION['user'] = $user->id;
                        $_SESSION['email'] = ucfirst($user->email);
                        $_SESSION['profile_picture'] = $user->profile_picture;
                        $loggedIn = true;
                        header('Location: ../');
                        break;
                    } else {
                        throw new Exception('Incorrect password');
                    }
                }
            }

            if (!$loggedIn) {
                throw new Exception('Incorrect Email');
            }
        } catch (Exception $e) {
            loadTemplate('user/login.twig', ['error' => $e->getMessage()]);
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
        try {
            // Check if username is already taken
            if (R::findOne('user', 'username = ?', [$_POST['username']])) {
                throw new Exception('Username is already taken');
            }

            // Check if passwords match
            if ($_POST['password'] != $_POST['confirm_password']) {
                throw new Exception('Passwords do not match');
            }

            // Check if any required field is empty
            $requiredFields = ['username', 'password', 'confirm_password', 'email', 'display_name', 'profile_picture'];
            foreach ($requiredFields as $field) {
                if (empty($_POST[$field])) {
                    throw new Exception('Please fill in all fields');
                }
            }

            // Register user
            $user = R::dispense('user');
            $user->username = $_POST['username'];
            $user->email = $_POST['email'];
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user->display_name = $_POST['display_name'];
            
            // Upload profile picture
            $directory = 'images/' . $_POST['username'] . '/';
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $fileName = uniqid() . '.png';
            var_dump($_FILES['profile_picture']['tmp_name']);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $directory . $fileName);
            $user->profile_picture = $directory . $fileName;

            R::store($user);

            // Log in user
            $_SESSION['user'] = $user->id;
            $_SESSION['username'] = ucfirst($user->username);
            $_SESSION['profile_picture'] = $user->profile_picture;
            header('Location: ../');
        } catch (Exception $e) {
            loadTemplate('user/register.twig', ['error' => $e->getMessage()]);
        }
    }
}
