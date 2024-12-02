<?php

namespace PrestaC\Controllers;

use DateTime;
use PDO;
use PrestaC\App\View;
use PrestaC\Models\User;

class AuthController
{
    protected PDO $db;

    function __construct(array $dependencies)
    {
        $this->db = $dependencies['db']->getConnection();
    }

    public function redirect()
    {
        // check if a user has logged in, if they are then redirect to dashboard
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location: /dashboard/home');
            exit();
        } else {
            header('Location: /guest');
            exit();
        }
    }

    public function guest()
    {
        session_start();
        View::render('guest', []);
    }

    public function login()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location: /dashboard/home');
            return;
        }
        View::render('login', []);
    }

    public function loginProcess()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        session_start();

        // Validate username exists
        $user = User::findByUsername($this->db, $username);
        if (!$user) {
            $_SESSION['error'] = "Invalid username or password";
            header('Location: /login');
            return;
        }

        // Validate password
        $isPasswordCorrect = $user->validatePassword($password);
        if (!$isPasswordCorrect) {
            $_SESSION['error'] = "Invalid username or password"; 
            header('Location: /login');
            return;
        }

        // Login successful
        $_SESSION['user'] = [
            'id' => $user->id,
            'fullName' => $user->fullName
        ];
        header('Location: /dashboard/home');
    }

    public function logout()
    {
        session_start();
        View::render('logout', []);
    }

    public function logoutProcess(): void
    {
        session_start();
        session_unset();
        session_destroy();
        
        header('Location: /guest');
        exit();
    }
}
