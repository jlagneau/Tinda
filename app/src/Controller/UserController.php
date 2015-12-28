<?php

namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controller\AbstractController as Controller;

final class UserController extends Controller
{
    public function login(Request $req, Response $res, $args)
    {
        $this->logger->info("Login page request");
        if (isset($_POST) && isset($_POST['username']) && isset($_POST['password'])) {
            $user = $this->userManager->getByUsername($_POST['username']);
            $password = hash('sha512', $_POST['password']);
            if ($user && ($password == $user->getPassword())) {
                $this->logger->notice("Login succeed [".$user->getUsername()."]");
                $_SESSION['login'] = $user->getUsername();

                return $res->withRedirect($this->router->pathFor('login'));
            } else {
                $this->logger->error("Login failed");
                $this->flash->addMessage('error', 'Authentification failed.');

                return $res->withRedirect($this->router->pathFor('login'));
            }
        }
        $this->view->render($res, 'Default/home.html.twig');

        return $res;
    }

    public function logout(Request $req, Response $res, $args)
    {
        $this->logger->info("Logout page request");
        $this->view->render($res, 'Default/home.html.twig');

        return $res;
    }

    public function register(Request $req, Response $res, $args)
    {
        $this->logger->info("Register page request");
        $this->view->render($res, 'Default/home.html.twig');

        return $res;
    }

    public function forgot(Request $req, Response $res, $args)
    {
        $this->logger->info("Forgot page request");
        $this->view->render($res, 'Default/home.html.twig');

        return $res;
    }

    public function reset(Request $req, Response $res, $args)
    {
        $this->logger->info("Reset page request");
        $this->view->render($res, 'Default/home.html.twig');

        return $res;
    }
}
