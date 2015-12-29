<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages();
};

// PDO
$container['pdo'] = function ($c) {
    $settings = $c->get('settings');
    try {
        $pdo = new \PDO($settings['pdo']['dsn']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE,
                           \PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Error : '.$e->getMessage());
    }

    return $pdo;
};

// Swiftmailer
$container['mailer'] = function ($c) {
    $transport = Swift_MailTransport::newInstance();
    $mailer = Swift_Mailer::newInstance($transport);

    return $mailer;
};

// CSRF
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute('csrf_status', false);

        return $next($request, $response);
    });

    return $guard;
};

// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));

    return $logger;
};

$container['userManager'] = function ($c) {
    $userManager = new App\Factory\UserManager($c);

    return $userManager;
};

// -----------------------------------------------------------------------------
// Action factories
// -----------------------------------------------------------------------------

$container['App\Controller\DefaultController'] = function ($c) {
    return new App\Controller\DefaultController($c);
};

$container['App\Controller\UserController'] = function ($c) {
    return new App\Controller\UserController($c);
};
