<?php
// Routes

// DefaultController
$app->get('/', 'App\Controller\DefaultController:home')->setName('home');

// UserController
$app->get('/logout', 'App\Controller\UserController:logout')->setName('logout');
$app->map(['GET', 'POST'], '/register', 'App\Controller\UserController:register')->setName('register');
$app->group('/login', function () {
    $this->map(['GET', 'POST'], '', 'App\Controller\UserController:login')->setName('login');
    $this->map(['GET', 'POST'], '/forgot', 'App\Controller\UserController:forgot')->setName('forgot');
    $this->map(['GET', 'POST'], '/reset-password', 'App\Controller\UserController:reset')->setName('reset');
});
