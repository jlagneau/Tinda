<?php

namespace App\Controller;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controller\AbstractController as Controller;

final class DefaultController extends Controller
{
    public function home(Request $req, Response $res, $args)
    {
        $this->flash->addMessage('success', 'This is a message, oh <strong>snap</strong> !');
        $flashbag = $this->flash->getMessages();
        $this->view->render($res, 'Default/home.html.twig', [
            'flashbag' => $flashbag,
        ]);

        return $res;
    }
}
